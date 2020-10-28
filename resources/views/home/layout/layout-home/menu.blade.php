<div class="section" id="category-product-wp">
    <div class="section-head">
        <h3 class="section-title">Danh mục sản phẩm</h3>
    </div>
    <div class="secion-detail">
        <ul class="list-item">
            @foreach($list_category as $detail_category)
            <li>
                <a href="{{route('product-by-category',$detail_category->slug)}}" title="">{{$detail_category->title}}</a>
                @if($detail_category->Child->first())
                    <ul class="sub-menu">
                        @foreach($detail_category->Child as $category_child_1)
                        <li>
                            <a href="{{route('product-by-category',$category_child_1->slug)}}" title="">{{$category_child_1->title}}</a>
                            @if($category_child_1->Child->first())
                                <ul class="sub-menu">
                                    @foreach($category_child_1->Child as $category_child_2)
                                    <li>
                                        <a href="{{route('product-by-category',$category_child_2->slug)}}" title="">{{$category_child_2->title}}</a>
                                        @if($category_child_2->Child->first())
                                            <ul class="sub-menu">
                                                @foreach($category_child_2->Child as $category_child_3)
                                                <li>
                                                    <a href="{{route('product-by-category',$category_child_3->slug)}}" title="">{{$category_child_3->title}}</a>
                                                    @if($category_child_3->Child->first())
                                                        <ul class="sub-menu">
                                                            @foreach($category_child_3->Child as $category_child_4)
                                                            <li>
                                                                <a href="{{route('product-by-category',$category_child_4->slug)}}" title="">{{$category_child_4->title}}</a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>
