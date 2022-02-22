<header id="header" class="header ">
   <div class="header-wrapper">
      <div id="masthead" class="header-main hide-for-sticky">
         <div class="header-inner flex-row container logo-left" role="navigation">
            <!-- Logo -->
            <div id="logo" class="flex-col logo">
               <!-- Header logo -->
               <a href="{{URL::to('/home')}}" title="Tin Tức 24h" rel="home">
               <img width="200" height="90" src="/DEMO/laravel_demo/public/uploads/logo.png" class="header_logo header-logo" alt="Tin tức 24h" style="width: 100%"><img width="200" height="90" src="uploads/logo.png" class="header-logo-dark" alt="Tin tức 24h"></a>
            </div>
            <!-- Mobile Left Elements -->
            <div class="flex-col show-for-medium flex-left">
               <ul class="mobile-nav nav nav-left ">
               </ul>
            </div>
            <!-- Left Elements -->
            <div class="flex-col hide-for-medium flex-left
               flex-grow">
               <ul class="header-nav header-nav-main nav nav-left  nav-uppercase">
                  <li class="header-search header-search-dropdown has-icon has-dropdown menu-item-has-children">
                     <a href="#" aria-label="Search" class="is-small"><i class="fa fa-search"></i></a>
                     <ul class="nav-dropdown nav-dropdown-default">
                        <li class="header-search-form search-form html relative has-icon">
                           <div class="header-search-form-wrapper">
                              <div class="searchform-wrapper ux-search-box relative is-normal">
                                 <form method="get" class="searchform" action="{{ route('search')}}" role="search">
                                    <div class="flex-row relative">
                                       <div class="flex-col flex-grow">
                                          <input type="search" class="search-field mb-0" name="s" value="" id="s" placeholder="Search…" autocomplete="off">
                                       </div>
                                       <div class="flex-col">
                                          <button type="submit" class="ux-search-submit submit-button secondary button icon mb-0" aria-label="Submit">
                                          <i class="fa fa-search"></i>              </button>
                                       </div>
                                    </div>
                                    <div class="live-search-results text-left z-top">
                                       <div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <!-- Right Elements -->
            <div class="flex-col hide-for-medium flex-right">
               <ul class="header-nav header-nav-main nav nav-right  nav-uppercase">
                  <li class="html header-social-icons ml-0">
                     <div class="social-icons follow-icons"><a href="https://www.facebook.com/profile.php?id=100007878886333" target="_blank" data-label="Facebook" rel="noopener noreferrer nofollow" class="icon primary button round facebook tooltip tooltipstered" style="padding-top: 7px "><i class="fa fa-facebook"></i></a><a href="https://www.facebook.com/profile.php?id=100007878886333" target="_blank" rel="noopener noreferrer nofollow" data-label="Instagram" class="icon primary button round instagram tooltip tooltipstered" style="padding-top: 7px "><i class="fa fa-instagram"></i></a><a href="https://www.facebook.com/profile.php?id=100007878886333" target="_blank" data-label="Twitter" rel="noopener noreferrer nofollow" class="icon primary button round twitter tooltip tooltipstered" style="padding-top: 7px "><i class="fa fa-twitter"></i></a><a href="mailto:doanhnguyentx@gmail.com" data-label="E-mail" rel="nofollow" class="icon primary button round email tooltip tooltipstered" style="padding-top: 7px "><i class="fa fa-envelope"></i></a><a href="https://www.facebook.com/profile.php?id=100007878886333" target="_blank" rel="noopener noreferrer nofollow" data-label="YouTube" class="icon primary button round youtube tooltip tooltipstered" style="padding-top: 7px "><i class="fa fa-youtube"></i></a></div>
                  </li>
               </ul>
            </div>
            <!-- Mobile Right Elements -->
            <div class="flex-col show-for-medium flex-right">
               <ul class="mobile-nav nav nav-right ">
                  <li class="nav-icon has-icon">
                     <a href="#" data-open="#main-menu" data-pos="left" data-bg="main-menu-overlay" data-color="" class="is-small" aria-label="Menu" aria-controls="main-menu" aria-expanded="false">
                     <i class="icon-menu"></i>
                     </a>
                  </li>
               </ul>
            </div>
         </div>
         <div class="container">
            <div class="top-divider full-width"></div>
         </div>
      </div>
      <div id="wide-nav" class="header-bottom wide-nav hide-for-sticky nav-dark hide-for-medium">
         <div class="flex-row container">
            <div class="flex-col hide-for-medium flex-left">
               <ul class="nav header-nav header-bottom-nav nav-left  nav-size-medium">
                  @foreach($all_category as  $cate)
                     <li id="menu-item" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-21" ><a href="{{ route('category', $cate->category_id)}}" class="nav-top-link" style="font-size: 1.2em;" >{{$cate->category_name}}</a></li>
                  @endforeach
               </ul>
               
            </div>
            <div class="flex-col hide-for-medium flex-right flex-grow">
               <ul class="nav header-nav header-bottom-nav nav-right  nav-size-medium">
               </ul>
            </div>
         </div>
      </div>
      <div class="header-bg-container fill">
         <div class="header-bg-image fill"></div>
         <div class="header-bg-color fill"></div>
      </div>
   </div>
</header>