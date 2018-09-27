@if(isset($page)&&$page->lastPage()>1)
<div class="page">
	{{$page->links('home.layouts.page-default2')}}
</div>
@endif