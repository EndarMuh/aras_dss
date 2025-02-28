<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
    <title>@yield('title') - Starter Template</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CSS Libraries -->
    @stack('customStyle')
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}" />
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                @include('layouts.navbar')
            </nav>
            <div class="main-sidebar sidebar-style-2">
                @include('layouts.sidebar')
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                @include('layouts.footer')
            </footer>
        </div>
    </div>

    {{-- Custom Javascript --}}

    <script>
        function addInputAlternative() {
            var newInput = document.createElement('div');
            newInput.innerHTML = `
            <div class="form-group">
                            <label>Alternatif</label>
                            <div class="row justify-content-between">
                                <div class="col-10">
                                    <input type="text" class="form-control" name="name_alternative[]" placeholder="masukkan nama alternatif" required>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-danger" onclick="removeInputAlternative(this)">Hapus</button>
                                </div>
                            </div>
            </div>
            `;
            document.getElementById('dynamicInputAlternative').appendChild(newInput);
        }

        function removeInputAlternative(button) {
            var formGroupDiv = button.closest('.form-group');
            if (formGroupDiv) {
                formGroupDiv.parentNode.removeChild(formGroupDiv);
                counterAlt--;
            }
        }

        function addInputCriteria() {
            var newInput = document.createElement('div');
            newInput.innerHTML = `
            <div class="form-group">
                <label>Kriteria</label>
                            <div class="row justify-content-between">
                                <div class="col-3">
                                    <input type="text" class="form-control" name="name_criteria[]" placeholder="masukkan nama alternatif" required>
                                </div>
                                <div class="col-3">
                                    <input type="number" class="form-control" name="weight[]" placeholder="masukkan bobot" required>
                                </div>
                                <div class="col-3">
                                    <select class="form-control" name="category[]">
                                        <option selected value="Benefit">Benefit</option>
                                        <option value="Cost">Cost</option>
                                      </select>
                                </div>
                                <div class="col-3">
                                    <button type="button" class="btn btn-danger" onclick="removeInputAlternative(this)">Hapus</button>
                                </div>
                              </div>
                        </div>
            `;

            document.getElementById('dynamicInputCriteria').appendChild(newInput);
        }

        function removeInputCriteria(button) {
            var formGroupDiv = button.closest('.form-group');
            if (formGroupDiv) {
                formGroupDiv.parentNode.removeChild(formGroupDiv);
            }
        }

        function addAlternative() {
            var container = document.getElementById('newAlternatives');
            var newInput = document.createElement('div');
            newInput.className = 'new-row'; // Tambahkan class baru
            newInput.innerHTML = `
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label>Alternatif</label>
                        <input type="text" name="name_alternative_new[]" class="form-control">
                    </div>
                </div>
                <div class="col-lg-2 mt-4">
                    <a href="#" onclick="removeAlternative(this)" class="btn btn-outline-danger">Hapus</a>
                </div>
            </div>
            `;
            container.appendChild(newInput);
        }

        function removeAlternative(element) {
            // Mendapatkan elemen parent dari elemen yang akan dihapus
            var parentElement = element.closest('.new-row');

            // Menghapus elemen parent dari dokumen
            parentElement.remove();
        }

        function addCriteria() {
            var container = document.getElementById('newCriterias');
            var newInput = document.createElement('div');
            newInput.className = 'new-row'; // Tambahkan class baru
            newInput.innerHTML = `
            <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Nama Kriteria</label>
                                            <input type="text" class="form-control" name="name_criteria_new[]" placeholder="masukkan nama alternatif" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Bobot</label>
                                            <input type="number" class="form-control" name="weight_new[]" step="any" placeholder="masukkan bobot" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Kriteria</label>
                                            <select class="form-control"  name="category_new[]">
                                                <option value="Benefit">Benefit</option>
                                                <option value="Cost">Cost</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mt-4">
                                        <a href="#" onclick="removeCriteria(this)" class="btn btn-outline-danger">Hapus</a>
                                    </div>
                                </div>
            `;
            container.appendChild(newInput);
        }

        function removeCriteria(element) {
            // Mendapatkan elemen parent dari elemen yang akan dihapus
            var parentElement = element.closest('.new-row');

            // Menghapus elemen parent dari dokumen
            parentElement.remove();
        }
    </script>

    <!-- General JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    @stack('customScript')
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
</body>

</html>
