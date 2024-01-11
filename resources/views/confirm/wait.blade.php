@extends('layouts.common')

@section('title')
    Wait
@endsection

@section('content')
    <main id="success-page">
        <section class="page-form">
            <div class="page-form__container">
                <div class="page-form__wrapper">
                    <h1>Очікуємо на підтвердження Email</h1>
                    <p>email можна відправити 1 раз в 10 хв, якщо лист не прийшов, відправте ще раз</p>
                    <form action="{{route('send_again_email')}}" method="POST" id="form">
                        @csrf
                        <button type="submit" class="btn btn-primary" id="submit_send" @if($send) disabled @endif>Відправити</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
