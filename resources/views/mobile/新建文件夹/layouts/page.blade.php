@if(isset($page)&&$page->lastPage()>1)
<div class="pagination">
	{{$page->links('home.layouts.page-default')}}
</div>
@endif