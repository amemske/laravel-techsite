@php
    $blogpost = App\Models\Blog::where('blog_category_id', $id)->orderBy('id', 'DESC')->get();
@endphp

<div class="col-lg-4">
    <aside class="blog__sidebar">
        <div class="widget">
            <form action="#" class="search-form">
                <input type="text" placeholder="Search">
                <button type="submit"><i class="fal fa-search"></i></button>
            </form>
        </div>
        <div class="widget">
            <h4 class="widget-title">Recent Blog</h4>
            <ul class="rc__post">
                @foreach($allBlogs as $item)
                    <li class="rc__post__item">
                        <div class="rc__post__thumb">
                            <a href="blog-details.html"><img src="{{asset($item->blog_image)}}" alt=""></a>
                        </div>
                        <div class="rc__post__content">
                            <h5 class="title"><a href="blog-details.html">{{$item->blog_title}}</a></h5>
                            <span class="post-date"><i class="fal fa-calendar-alt"></i> {{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="widget">
            <h4 class="widget-title">Categories</h4>
            <ul class="sidebar__cat">
                @foreach($blogCategories as $cat)
                    <li class="sidebar__cat__item"><a href="{{route('category.blog', $cat->id)}}">{{$cat->blog_category}}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="widget">
            <h4 class="widget-title">Popular Tags</h4>
            <ul class="sidebar__tags">
                @foreach($allBlogs as $tag)
                    <li><a href="blog.html">{{$tag->blog_tags}}</a></li>
                @endforeach
            </ul>
        </div>
    </aside>
</div>
