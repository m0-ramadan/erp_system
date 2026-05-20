<script src="{{ asset('dashboard/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/js/menu.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/main.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const appSplash = document.getElementById('appSplash');
        const pageLoader = document.getElementById('appPageLoader');
        const installBanner = document.getElementById('appInstallBanner');
        const installAction = document.getElementById('appInstallAction');
        const installDismiss = document.getElementById('appInstallDismiss');
        const menuToggle = document.querySelector('.layout-menu-toggle .nav-item, .layout-menu-toggle.menu-link');
        let deferredInstallPrompt = null;

        window.setTimeout(function () {
            appSplash?.classList.add('is-hidden');
        }, 550);

        window.addEventListener('pageshow', function () {
            pageLoader?.classList.remove('is-visible');
        });

        document.querySelectorAll('a[href]').forEach(function (link) {
            link.addEventListener('click', function () {
                const href = this.getAttribute('href');
                const isNewTab = this.getAttribute('target') === '_blank';
                const isHash = !href || href.startsWith('#') || href.startsWith('javascript:');
                const isExternal = href && /^https?:\/\//.test(href) && !href.includes(window.location.host);

                if (!isNewTab && !isHash && !isExternal) {
                    pageLoader?.classList.add('is-visible');
                }
            });
        });

        document.querySelector('[data-app-menu-toggle]')?.addEventListener('click', function () {
            menuToggle?.dispatchEvent(new MouseEvent('click', {bubbles: true}));
        });

        document.querySelectorAll('[data-delete-url]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const url = this.getAttribute('data-delete-url');
                const title = this.getAttribute('data-delete-title') || 'هل تريد الحذف؟';
                const submitDelete = function () {
                    const form = document.getElementById('form_action_delete');
                    form.setAttribute('action', url);
                    form.submit();
                };
                if (window.Swal) {
                    Swal.fire({
                        title: title,
                        text: 'لا يمكن التراجع عن هذه العملية بعد تنفيذها',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'نعم، حذف',
                        cancelButtonText: 'إلغاء',
                        customClass: {confirmButton: 'btn btn-danger me-2', cancelButton: 'btn btn-label-secondary'},
                        buttonsStyling: false
                    }).then(function (result) { if (result.isConfirmed) submitDelete(); });
                } else if (confirm(title)) {
                    submitDelete();
                }
            });
        });

        document.querySelectorAll('input[type="file"][data-app-file]').forEach(function (input) {
            const wrapper = input.closest('.app-file-shell');
            const nameTarget = wrapper?.querySelector('[data-file-name]');
            const cameraButton = wrapper?.querySelector('[data-file-capture]');
            const browseButton = wrapper?.querySelector('[data-file-browse]');

            const refreshName = function () {
                if (!nameTarget) return;
                const names = Array.from(input.files || []).map(function (file) {
                    return file.name;
                });
                nameTarget.textContent = names.length ? names.join('، ') : 'لم يتم اختيار ملف بعد';
            };

            cameraButton?.addEventListener('click', function () {
                input.setAttribute('capture', 'environment');
                input.click();
            });

            browseButton?.addEventListener('click', function () {
                input.removeAttribute('capture');
                input.click();
            });

            input.addEventListener('change', refreshName);
            refreshName();
        });

        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function () {
                navigator.serviceWorker.register('{{ asset('sw.js') }}').catch(function () {
                    return null;
                });
            });
        }

        window.addEventListener('beforeinstallprompt', function (event) {
            event.preventDefault();
            deferredInstallPrompt = event;
            installBanner?.classList.add('is-visible');
        });

        installAction?.addEventListener('click', async function () {
            if (!deferredInstallPrompt) return;
            deferredInstallPrompt.prompt();
            await deferredInstallPrompt.userChoice;
            deferredInstallPrompt = null;
            installBanner?.classList.remove('is-visible');
        });

        installDismiss?.addEventListener('click', function () {
            installBanner?.classList.remove('is-visible');
        });

        window.addEventListener('online', function () {
            const offlineNote = document.getElementById('appOfflineToast');
            offlineNote?.remove();
        });

        window.addEventListener('offline', function () {
            if (document.getElementById('appOfflineToast')) return;

            const toast = document.createElement('div');
            toast.id = 'appOfflineToast';
            toast.className = 'app-page-loader is-visible';
            toast.innerHTML = '<span class="dot"></span><strong>أنت الآن بدون اتصال. سيتم استخدام النسخة المخزنة عند الإمكان.</strong>';
            document.body.appendChild(toast);
        });
    });
</script>
