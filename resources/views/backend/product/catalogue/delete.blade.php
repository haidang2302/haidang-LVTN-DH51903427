@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['delete']['title']])
@include('backend.dashboard.component.formError')
@if($productCatalogue)
<form action="{{ route('product.catalogue.destroy', $productCatalogue->id) }}" method="post" class="box">
    @include('backend.dashboard.component.destroy', ['model' => ($productCatalogue) ?? null])
</form>
@else
<div class="alert alert-danger">Không tìm thấy danh mục này!</div>
@endif
