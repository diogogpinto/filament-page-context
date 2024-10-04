<?php

namespace DiogoGPinto\FilamentPageContext;

use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FilamentPageContext
{
    public array $breadcrumbs = [];

    public string $pageTitle = '';

    private mixed $resource = null;

    private ?Model $record = null;

    public function __construct()
    {
        $this->generateBreadcrumbs();
        $this->setPageTitle();
    }

    public function generateBreadcrumbs(): void
    {
        $this->resource = $this->getResource();
        $this->addResourceBreadcrumb();
        $this->addRecordBreadcrumb();
        $this->addControllerBreadcrumb();
        $this->addClusterBreadcrumbs();
    }

    protected function addResourceBreadcrumb(): void
    {
        if ($this->resource) {
            $this->breadcrumbs[$this->resource->getUrl()] = $this->resource->getBreadcrumb();
        }
    }

    protected function addRecordBreadcrumb(): void
    {
        if (! $this->resource || ! request()->record) {
            return;
        }

        $this->resolveRecord(request()->record);

        $url = $this->getRecordUrl();
        $title = $this->getRecordTitle();

        if ($url) {
            $this->breadcrumbs[$url] = $title;
        } else {
            $this->breadcrumbs[] = $title;
        }
    }

    protected function addControllerBreadcrumb(): void
    {
        if (method_exists(request()->route()->controller, 'getBreadcrumb')) {
            $this->breadcrumbs[] = request()->route()->controller->getBreadcrumb();
        }
    }

    protected function addClusterBreadcrumbs(): void
    {
        if ($this->resource && ($cluster = $this->resource->getCluster())) {
            $this->breadcrumbs = (new $cluster)->unshiftClusterBreadcrumbs($this->breadcrumbs);
        }
    }

    protected function getRecordUrl(): ?string
    {
        if ($this->resource::hasPage('view') && $this->resource::canView($this->record)) {
            return $this->resource::getUrl('view', ['record' => $this->record]);
        }
        if ($this->resource::hasPage('edit') && $this->resource::canEdit($this->record)) {
            return $this->resource::getUrl('edit', ['record' => $this->record]);
        }

        return null;
    }

    protected function getResource(): ?Resource
    {
        if (method_exists(request()->route(), 'getController') && method_exists(request()->route()->getController(), 'getResource')) {
            return new (request()->route()->getController()->getResource());
        }

        return null;
    }

    protected function getRecordTitle(): string
    {
        return $this->resource::hasRecordTitle()
            ? $this->resource::getRecordTitle($this->record)
            : $this->resource::getTitleCaseModelLabel();
    }

    protected function setPageTitle(): void
    {
        $this->pageTitle = empty($this->record) ? $this->getDefaultTitle() : $this->getRecordTitle();
    }

    protected function getDefaultTitle(): string
    {
        if (method_exists(request()->route()->controller, 'getTitle')) {
            return request()->route()->controller->getTitle();
        }

        return $this->resource::getTitleCaseModelLabel();
    }

    public function resolveRecord(int | string $key): void
    {
        $this->record = $this->resource::resolveRecordRouteBinding($key);
        if ($this->record === null) {
            throw (new ModelNotFoundException)->setModel(request()->route()->controller->getModel(), [$key]);
        }
    }
}
