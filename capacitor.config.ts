import type { CapacitorConfig } from '@capacitor/cli';

const config: CapacitorConfig = {
  appId: 'com.stackmind.erp',
  appName: 'ERP System',
  webDir: 'public',
  server: {
    url: 'https://erp.stackmind.org',
    cleartext: false
  }
};

export default config;
