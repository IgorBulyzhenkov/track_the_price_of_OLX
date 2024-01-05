@extends('layouts.common')

@section('title')
    Register
@endsection

@section('content')
    <main id="success-page">
        <section class="page-form">
            <div class="page-form__container">
                <div class="page-form__wrapper">
                    <form action="{{ route('reg.create') }}" method="POST" class="page-form__info form">
                        @csrf
                        <h3 class="form__title">Зареєструватися</h3>
                        <div class="form__wrap">
                            <div class="form__item">
                                <label class="w-100">
                                    <input data-error="Введіть ім'я" data-required="name" data-validate name="name" type="text" placeholder="Введіть ім'я" class="form__input">
                                </label>
                            </div>
                            <div class="form__item">
                                <label class="w-100">
                                    <input data-error="Введіть Емейл" data-required="email" data-validate name="email" type="email" placeholder="Введіть Емейл" class="form__input">
                                </label>
                            </div>
                            <div class="form__item">
                                <label class="w-100">
                                    <input data-error="Повторіть емейл" data-required="email2" data-validate name="email2" type="email" placeholder="Введіть повторно Емейл" class="form__input">
                                </label>
                            </div>
                            <div class="form__item">
                                <label class="w-100">
                                    <input data-error="Введіть пароль" data-required="password" data-validate name="password" type="password" placeholder="Введіть пароль" class="form__input">
                                </label>
                            </div>
                            <div class="form__item">
                                <label class="w-100">
                                    <input data-error="Повторіть пароль" data-required="password2" data-validate name="password2" type="password" placeholder="Введіть повторно пароль" class="form__input">
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="form__button btn">Зареєструватися</button>
                        <a href="{{ route('login') }}" class="form__link">Вхід</a>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
