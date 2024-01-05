@extends('layouts.common')

@section('title')
    Login
@endsection

@section('content')
    <main id="success-page">
        <section class="page-form">
            <div class="page-form__container">
                <div class="page-form__wrapper">
                    <form action=" {{ route('login.create') }}" method="POST" class="page-form__info form">
                        @csrf
                        <h3 class="form__title">Вхід</h3>
                        <div class="form__wrap">
                            <div class="form__item">
                                <label class="w-100">
                                    <input data-error="Введіть Емейл" data-required="email" data-validate name="email" type="email" placeholder="Введіть Емейл" class="form__input">
                                </label>
                            </div>
                            <div class="form__item">
                                <label class="w-100">
                                    <input data-error="Введіть пароль" data-required="password" data-validate name="password" type="password" placeholder="Введіть пароль" class="form__input">
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="form__button btn">Вхід</button>
                        <a href="{{ route('register') }}" class="form__link">Зареєструватися</a>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
