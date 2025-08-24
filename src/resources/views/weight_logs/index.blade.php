@extends('layouts.app')

@section('content')
<div class="weight-logs__page">

    {{-- 目標体重まで --}}
    <table class="weight-logs__goal">
        <tr>
            <th>目標体重</th>
            <th>目標まで</th>
            <th>最新体重</th>
        </tr>
        <tr>
            <td>{{ number_format($goalWeight, 1) }} <span>kg</span></td>
            <td>{{ number_format($goalWeightDiff, 1) }} <span>kg</span></td>
            <td>{{ number_format($latestWeight, 1) }} <span>kg</span></td>
        </tr>
    </table>

    <div class="weight__logs">

        <div class="weight__logs-header">
            {{-- 検索フォーム --}}
            <form action="{{ route('weight_logs.search') }}" method="get" class="search-form">
                <input type="date" name="from" value="{{ request('from') }}">
                <span>～</span>
                <input type="date" name="to" value="{{ request('to') }}">
                <button class="search__button-submit" type="submit">検索</button>
                @if(request()->has('from') || request()->has('to'))
                    <a href="{{ route('weight_logs.index') }}">リセット</a>
                @endif
            </form>

            {{-- データ追加ボタン --}}
            <button type="button" class="open-modal" data-modal="addModal">データを追加</button>
        </div>

        {{-- 検索結果ヘッダー --}}
        @if(isset($searchCount))
            <p>{{ request('from') }}〜{{ request('to') }} の検索結果 {{ $searchCount }}件</p>
        @endif

        {{-- 一覧テーブル --}}
        <table class="weight-logs">
            <tr>
                <th>日付</th>
                <th>体重</th>
                <th>摂取カロリー</th>
                <th>運動時間</th>
                <th></th>
            </tr>
            @foreach($weightLogs as $log)
            <tr>
                <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                <td>{{ number_format($log->weight, 1) }} kg</td>
                <td>{{ $log->calories }} cal</td>
                <td>{{ \Carbon\Carbon::parse($log->exercise_time)->format('H:i') }}</td>
               <td class="row-detail">
                    <a href="{{ route('weight_logs.show', $log->id) }}" class="edit-button">
                        <img src="{{ asset('images/pencil.icon.svg') }}" alt="更新" class="edit-icon">
                    </a>
                </td>
            </tr>
            @endforeach
        </table>

        {{-- ページネーション --}}
        <div class="pagination">
            {{ $weightLogs->links() }}
        </div>

    </div>
</div>
@endsection('content')

{{-- ▼ モーダル（追加登録フォーム） --}}
<div id="addModal" class="modal" style="display: {{ $errors->any() ? 'block' : 'none' }};">
    <div class="modal__content">
        <h2>Weight Logを追加</h2>

        <form action="{{ route('weight_logs.store') }}" method="post">
            @csrf

            {{-- 日付 --}}
            <div>
                <label>日付<span class="required">必須</span></label>
                <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}">
                @error('date') <p class="error">{{ $message }}</p> @enderror
            </div>

            {{-- 体重 --}}
            <div>
                <label>体重<span class="required">必須</span></label>
                <div class="input-with-unit">
                    <input type="text" name="weight" value="{{ old('weight') }}">
                    <span>kg</span>
                </div>
                @error('weight') <p class="error">{{ $message }}</p> @enderror
            </div>

            {{-- 摂取カロリー --}}
            <div>
                <label>摂取カロリー<span class="required">必須</span></label>
                <div class="input-with-unit">
                    <input type="text" name="calories" value="{{ old('calories') }}">
                    <span>cal</span>
                </div>
                @error('calories') <p class="error">{{ $message }}</p> @enderror
            </div>

            {{-- 運動時間 --}}
            <div>
                <label>運動時間<span class="required">必須</span></label>
                <input type="time" name="exercise_time" value="{{ old('exercise_time') }}">
                @error('exercise_time') <p class="error">{{ $message }}</p> @enderror
            </div>

            {{-- 運動内容 --}}
            <div>
                <label>運動内容</label>
                <textarea name="exercise_content">{{ old('exercise_content') }}</textarea>
                @error('exercise_content') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="modal__actions">
                <button type="button" class="close-modal" data-modal="addModal">戻る</button>
                <button type="submit">登録</button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // モーダル開閉処理
    document.querySelectorAll('.open-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById(btn.dataset.modal).style.display = 'block';
        });
    });
    document.querySelectorAll('.close-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById(btn.dataset.modal).style.display = 'none';
        });
    });

    // バリデーションエラーがある場合、モーダルを自動オープン
    @if($errors->any())
        document.getElementById('addModal').style.display = 'block';
    @endif
});
</script>
@endsection
