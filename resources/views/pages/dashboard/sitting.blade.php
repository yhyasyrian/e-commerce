@section('title')
إضافة أدمن
@endsection
@section('app')
    @include('layouts.navbarAdmin')
    <div class="dashboard w-[calc(100%-4rem)] transition-all duration-300 ease-linear">
        <h2 class="title-table">الاعدادات</h2>
        <form action="" method="POST" class="sitting">
            @csrf
            @foreach ($commands as $command)
                <label for="{{ $command['id'] }}">{{ $command['name'] }}:</label>
                <input type="{{ $command['type'] }}" name="{{ $command['id'] }}" id="{{ $command['id'] }}" value="{{ $command['value'] }}" @required($command['required']) @class(['hidden' => ($command['type'] == 'file')])>
                @if ($command['type'] == 'file')
                    <input type="text" disabled value="لا يوجد صورة" id="filePhoto">
                @endif
            @endforeach
            <input type="submit" value="حفظ" class="button-blue w-fit mx-auto px-12 mb-4">
        </form>
    </div>
@endsection
@include('pages.home')