@section('title','الصفحة الرئيسية')
@section('app')
    {{-- Hero --}}
    <section id="hero" class="flex-page">
        <div class="content">
            <h1>{{ \App\Http\Controllers\Site\VarController::getSitting('title') }}</h1>
            <p>{{ \App\Http\Controllers\Site\VarController::getSitting('des') }}</p>
            <a href="#moreInformation" class="button-blue mx-auto">المزيد</a>
        </div>
        <div class="image">
            <img src="{{ asset('images/undraw_stripe_payments_re_chlm.svg') }}" alt="{{ \App\Http\Controllers\Site\VarController::getSitting('title') }}">
        </div>
    </section>
    {{-- Why Our --}}
    <h2 class="text-center title-table scroll-mt-[73px] md:scroll-mt-[80px]" id="moreInformation">نحن فخورون ب</h2>
    <section class="boxs relative mt-6 lg:grid-cols-3">
        <div class="box">
            <span class="icon"><i class="fa-solid fa-tags"></i></span>
            <div>
                <h3>عدد المنتجات</h3>
                <p>{{ ($product->num ?? 0) }}</p>
            </div>
        </div>
        <div class="box">
            <span class="icon"><i class="fa-solid fa-users"></i></span>
            <div>
                <h3>أشخاص تثق بنا</h3>
                <p>{{ ($user->num ?? 0) }}</p>
            </div>
        </div>
        <div class="box">
            <span class="icon"><i class="fa-solid fa-coins"></i></span>
            <div>
                <h3>المبالغ المدفوعة</h3>
                <p>{{ ($sell->price ?? 0) }}</p>
            </div>
        </div>
    </section>
    {{-- products --}}
    <section id="products" class="scroll-mt-[73px] md:scroll-mt-[80px]" data-url-products="{{ route('productesGet') }}">
    {{-- set route api for get products and limte in all pages 10 example: domain.com/api/products?page=--}}
        <div class="products">
            {{-- @for ($i=0;$i<=10;$i++) --}}

            @foreach ($products as $p )
            <article>
                <div class="img">
                    <a href="{{ route('user.product',['uri'=>$p['link']]) }}">
                        <img src="{{ asset($p['image']) }}" alt="العنوان" loading="lazy">
                    </a>
                </div>
                <div class="content">
                    <a href="{{ route('user.product',['uri'=>$p['link']]) }}"><h3>{{ $p['title'] }}</h3></a>
                    <p>{{ $p['des'] }} </p>
                    <a href="{{ route('user.product',['uri'=>$p['link']]) }}" class="button-blue">المزيد من المعلومات</a>
                </div>
                <a class="category" href="{{ route('user.category',['uri'=>$p['linkCategory']]) }}">{{ $p['category'] }}</a>
            </article>
            @endforeach
            {{-- @endfor --}}
        </div>
        <button class="block w-fit mx-auto mt-4 button-blue px-6" id="moreProducts">
            المزيد
            <span class="hidden">
                <i class="fa-solid fa-spinner animate-spin"></i>
            </span>
        </button>
    </section>
    {{-- What Our --}}
    <section class="flex-page min-h-[50vh]">
        <div class="content">
            <h2>لماذا نحن</h2>
            <p>{{ \App\Http\Controllers\Site\VarController::getSitting('why-we') }}</p>
        </div>
        <div class="image">
            <img src="{{ asset('images/undraw_working_re_ddwy.svg') }}" alt="لماذا نحن">
        </div>
    </section>
@endsection
@include('pages.home')
