<div class="col-lg-3">
    <div class="mt-4">
        <img class="img-thumbnail w-100" style="width: 200px; height: 300px" src="{{$category->image}}" alt="slide-image" />
    </div>
    <!-- end slider -->

    <div class="mt-4 justify-content-center">
        <h6>{{__('text.Category Name')}} : <span class="text-pink">{{app()->getLocale()=='ar' ? $category->name_ar : $category->name_en}}</span></h6>
        <h6>{{__('text.Number of Products')}} : <span class="text-pink">{{$category->products->count()}}</span></h6>
        {{--<h6 class="text-overflow">{{__('text.Sub Categories')}}</h6>
        @forelse($category->child_categories as $child)
            <p class="mt-3"><a href="/admin/category/{{$child->id}}-{{$child->slug}}">{{app()->getLocale() == 'ar' ? $child->name_ar:$child->name_en}}</a></p>
        @empty
            <p class="text-muted">
                {{__('text.Doesn\'t have sub categories')}}
            </p>
    @endforelse--}}
    <!-- end row -->
        <div class="col-12">
            <div class="text-center card-box">
                <div class="text-left">
                    <h4 class="header-title mb-4">{{__('text.Author')}}</h4>
                </div>
                <div class="member-card">
                    <div class="avatar-xl member-thumb mb-2 mx-auto d-block">
                        <img src="{{auth()->user()->image }}" class="rounded-circle img-thumbnail" style="width: 100px;height: 100px" alt="profile-image">
                        <i class="mdi mdi-star-circle member-star text-success" title="Featured Agent"></i>
                    </div>

                    <div class="">
                        <h5 class="font-18 mb-1">{{auth()->user()->name}}</h5>
                    </div>

                </div>
                <!-- end membar card -->
            </div>
            <!-- end card-box -->
        </div>
    </div>

</div>
