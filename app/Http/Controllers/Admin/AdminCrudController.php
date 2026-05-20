<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

abstract class AdminCrudController extends Controller
{
    protected string $modelClass;
    protected string $viewPath = '';
    protected string $routeName = '';
    protected array $with = [];
    protected array $withCount = [];
    protected array $searchable = [];
    protected array $filterable = [];
    protected array $storeRules = [];
    protected array $updateRules = [];
    protected string $defaultSort = 'id';
    protected string $defaultDirection = 'desc';
    protected ?string $statusField = 'status';

    public function index(Request $request)
    {
        $query = $this->modelClass::query();
        $this->applyRelations($query);
        $this->applySearch($query, $request);
        $this->applyFilters($query, $request);
        $this->applyDateFilters($query, $request);

        $stats = $this->buildStats($request);

        $sortField = $request->get('sort_field', $this->defaultSort);
        $sortDirection = strtolower($request->get('sort_direction', $this->defaultDirection)) === 'asc' ? 'asc' : 'desc';

        $items = $query->orderBy($sortField, $sortDirection)
            ->paginate((int) $request->get('per_page', 15))
            ->withQueryString();

        if ($request->wantsJson() || ! View::exists($this->viewPath . '.index')) {
            return response()->json([
                'success' => true,
                'data' => $items,
                'stats' => $stats,
                'filters' => $request->all(),
            ]);
        }

        return view($this->viewPath . '.index', [
            'items' => $items,
            'stats' => $stats,
            'filters' => $request->all(),
        ]);
    }

    public function create(Request $request)
    {
        if ($request->wantsJson() || ! View::exists($this->viewPath . '.create')) {
            return response()->json(['success' => true]);
        }

        return view($this->viewPath . '.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->storeRules);

        if ($validator->fails()) {
            return $this->validationFailed($request, $validator);
        }

        DB::beginTransaction();
        try {
            $data = $validator->validated();
            $data = $this->beforeStore($data, $request);
            $item = $this->modelClass::create($data);
            $this->afterStore($item, $request);

            DB::commit();

            return $this->successResponse($request, $item->fresh($this->with), 'تم الحفظ بنجاح');
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->errorResponse($request, 'حدث خطأ أثناء الحفظ: ' . $e->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        $item = $this->modelClass::with($this->with)->findOrFail($id);

        if ($request->wantsJson() || ! View::exists($this->viewPath . '.show')) {
            return response()->json(['success' => true, 'data' => $item]);
        }

        return view($this->viewPath . '.show', compact('item'));
    }

    public function edit(Request $request, $id)
    {
        $item = $this->modelClass::with($this->with)->findOrFail($id);

        if ($request->wantsJson() || ! View::exists($this->viewPath . '.edit')) {
            return response()->json(['success' => true, 'data' => $item]);
        }

        return view($this->viewPath . '.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = $this->modelClass::findOrFail($id);
        $rules = $this->updateRules ?: $this->storeRules;
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->validationFailed($request, $validator);
        }

        DB::beginTransaction();
        try {
            $data = $validator->validated();
            $data = $this->beforeUpdate($data, $request, $item);
            $item->update($data);
            $this->afterUpdate($item, $request);

            DB::commit();

            return $this->successResponse($request, $item->fresh($this->with), 'تم التحديث بنجاح');
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->errorResponse($request, 'حدث خطأ أثناء التحديث: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        $item = $this->modelClass::findOrFail($id);

        DB::beginTransaction();
        try {
            $this->beforeDestroy($item, $request);
            $item->delete();
            DB::commit();

            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'تم الحذف بنجاح']);
            }

            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->errorResponse($request, 'حدث خطأ أثناء الحذف: ' . $e->getMessage());
        }
    }

    protected function applyRelations(Builder $query): void
    {
        if ($this->with) {
            $query->with($this->with);
        }

        if ($this->withCount) {
            $query->withCount($this->withCount);
        }
    }

    protected function applySearch(Builder $query, Request $request): void
    {
        if (! $request->filled('search') || empty($this->searchable)) {
            return;
        }

        $search = trim((string) $request->search);
        $query->where(function (Builder $builder) use ($search) {
            foreach ($this->searchable as $field) {
                $builder->orWhere($field, 'like', "%{$search}%");
            }

            if (is_numeric($search)) {
                $builder->orWhere('id', (int) $search);
            }
        });
    }

    protected function applyFilters(Builder $query, Request $request): void
    {
        foreach ($this->filterable as $field) {
            if ($request->filled($field)) {
                $query->where($field, $request->get($field));
            }
        }
    }

    protected function applyDateFilters(Builder $query, Request $request): void
    {
        $dateField = $request->get('date_field', 'created_at');

        if ($request->filled('date_from')) {
            $query->whereDate($dateField, '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate($dateField, '<=', $request->date_to);
        }
    }

    protected function buildStats(Request $request): array
    {
        $model = new $this->modelClass;
        $query = $this->modelClass::query();
        $stats = ['total' => (clone $query)->count()];

        if ($this->statusField && in_array($this->statusField, $model->getFillable(), true)) {
            $stats['by_status'] = (clone $query)
                ->select($this->statusField, DB::raw('COUNT(*) as total'))
                ->groupBy($this->statusField)
                ->pluck('total', $this->statusField)
                ->toArray();
        }

        return $stats;
    }

    protected function beforeStore(array $data, Request $request): array
    {
        return $data;
    }

    protected function afterStore(Model $item, Request $request): void
    {
    }

    protected function beforeUpdate(array $data, Request $request, Model $item): array
    {
        return $data;
    }

    protected function afterUpdate(Model $item, Request $request): void
    {
    }

    protected function beforeDestroy(Model $item, Request $request): void
    {
    }

    protected function validationFailed(Request $request, $validator)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'خطأ في البيانات المرسلة',
                'errors' => $validator->errors(),
            ], 422);
        }

        return redirect()->back()->withErrors($validator)->withInput();
    }

    protected function successResponse(Request $request, Model $item, string $message)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $item,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    protected function errorResponse(Request $request, string $message, int $code = 500)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => $message,
            ], $code);
        }

        return redirect()->back()->with('error', $message)->withInput();
    }
}
