<div class="post-sidebar large-4 col">
   <div id="secondary" class="widget-area " role="complementary">
      <aside id="search-2" class="widget widget_search">
         <form method="get" class="searchform" action="{{ route('search')}}" role="search">
            <div class="flex-row relative">
               <div class="flex-col flex-grow">
                  <input type="search" class="search-field mb-0" name="s" value="" id="s" placeholder="Search…" autocomplete="off">
               </div>
               <div class="flex-col">
                  <button type="submit" class="ux-search-submit submit-button secondary button icon mb-0" aria-label="Submit">
                  <i class="fa fa-search"></i>            </button>
               </div>
            </div>
            <div class="live-search-results text-left z-top">
               <div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div>
            </div>
         </form>
      </aside>
      <aside id="flatsome_recent_posts-2" class="widget flatsome_recent_posts">
         <span class="widget-title "><span>Mới Nhất</span></span>
         <div class="is-divider small"></div>
         <ul>
            @foreach($all_post as $post)
               <li class="recent-blog-posts-li">
                  <a href="{{ route('post.index', $post->post_id)}}" title="{{ $post->post_title }}</">
                  <div class="flex-row recent-blog-posts align-top pt-half pb-half">
                     <div class="flex-col mr-half">
                        <div class="badge post-date badge-small badge-outline">
                           <div class="badge-inner bg-fill">
                              <img src="{{asset($post->post_image)}}" style="width: 120px;height: 70px "> 
                           </div>
                        </div>
                     </div>
                     <div class="flex-col flex-grow">
                        <small>{{ $post->post_day }}</small>
                        <a href="{{$post->post_id}}" title="{{ $post->post_title }}</">{{ $post->post_title }}</a>
                        <span class="post_comments op-7 block is-xsmall"><a href="./post/{{$post->post_id}}"></a></span>
                     </div>
                  </div>
                  </a>
               </li>
            @endforeach
         </ul>
      </aside>
   </div>
</div>