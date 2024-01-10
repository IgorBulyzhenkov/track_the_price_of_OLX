@extends('layouts.common')

@section('title')
    Home
@endsection

@section('content')
    <main id="success-page">
        <section class="page-form">
            <div class="container">
                <div class="d-flex mb-5 align-items-center justify-content-between container_new_category position-relative">
                    <p class="m-0 title_new_category">Додати новий товар</p>
                    <a class="link_new_category btn btn-info" title="Додати новий товар" id="new_product"><i
                            class="fa-solid fa-circle-plus icon_plus_link"></i>Додати</a>
                    <div class="modal_new" id="modal_new">
                        <div>
                            <form action="{{ route('product.create') }}" method="POST" class="page-form__info form" id="form_save">
                                @csrf
                                <h3 class="form__title">Новий товар</h3>
                                <div class="form__wrap">
                                    <div class="form__item">
                                        <label class="w-100">
                                            <input data-error="Введіть посилання на товар" data-required="text"
                                                   data-validate name="link" type="text" id="link"
                                                   placeholder="Введіть посилання на товар" class="form__input">
                                        </label>
                                    </div>
                                    <div class="form__item">
                                        <label class="w-100">
                                            Перевіряти ціну, раз в:
                                            <select class="form__select" name="time_update">
                                                <option value="1">1 годину</option>
                                                <option value="5">5 годин</option>
                                                <option value="12">12 годин</option>
                                                <option value="24">1 день</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="form__button btn" id="btn_submit">Зберегти</button>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="container page-form__container" style="padding: 0; width: 100%">
                    <div class="table-responsive" style="padding: 0 15px;">
                        @if(!empty($data))
                            <table id="myTable" style="padding: 0 15px; width: 100%;" class="display">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ім'я</th>
                                    <th>Ціна</th>
                                </tr>
                                </thead>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

@push('scripts')
    <script src="/js/datatables.js"></script>
    <script type="module">

        const table = $('#myTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/uk.json',
            },
            data: {!! json_encode( $data ) !!}
        });

    </script>
@endpush
