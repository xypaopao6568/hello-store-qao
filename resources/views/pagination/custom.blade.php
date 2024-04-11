
<style type="text/css">
    ul.custom-paginate{
        margin: auto;
        padding: 0;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
    }
    ul.custom-paginate li a{
        border: 1px solid #17a2b8;
        border-radius: 4px;
        cursor: pointer;
        padding: 10px 15px;
        color: #17a2b8;
        font-size: 16px;
    }
    ul.custom-paginate li a:hover{
        background: #17a2b8;
        color: #FFFFFF;
    }
    ul.custom-paginate li:hover{
    }
    ul.custom-paginate li:hover > a{
    }
    ul.custom-paginate li{
        list-style-type: none;
        margin: 15px 2px;
    }
    ul.custom-paginate li.active span{
        background:#17a2b8;
        color: #FFFFFF;
        border: 1px solid #17a2b8;
        border-radius: 4px;
        padding: 10px 15px;
        cursor: unset!important;
        font-size: 16px;
    }
</style>
@if ($paginator->hasPages())
<ul class="custom-paginate">

    @if (!$paginator->onFirstPage())
        <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fas fa-arrow-left"></i></a></li>
    @endif



    @foreach ($elements as $element)

        @if (is_string($element))
            <li class="disabled"><span>{{ $element }}</span></li>
        @endif



        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active"><span>{{ $page }}</span></li>
                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach



    @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fas fa-arrow-right"></i></a></li>
    @endif
</ul>
@endif
