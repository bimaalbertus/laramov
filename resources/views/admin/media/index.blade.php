@extends('layouts.admin')
@section('title', 'Media CRUD')

@section('content')
    <div class="relative p-10">

        <x-alert type="error" :message="session('error')" id="error-alert" duration="10000" />
        <x-alert type="success" :message="session('success')" id="success-alert" duration="10000" />

        @include('admin.components.admin-header', [
            'name' => 'media',
            'title' => 'All media',
            'placeholder' => 'Search for media...',
            'search' => 'block',
            'formId' => 'delete-all-movies',
            'formTitle' => 'Delete All Movies',
            'formMessage' => 'Are you sure want to delete all movies?',
        ])

        <div id="resultsContainer">
            @include('admin.media.media-list', ['media' => $media])
        </div>
    </div>

@endsection

@section('script')
    <script>
        const searchInput = document.getElementById('default-search');
        const resultsContainer = document.getElementById('resultsContainer');

        function fetchMediaData(query = '') {
            const formData = new FormData();
            formData.append('query', query);

            fetch('/admin/media/search', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    resultsContainer.innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
        }

        searchInput.addEventListener('input', function() {
            const query = this.value;

            if (query.length === 0) {
                fetchMediaData('');
            } else if (query.length > 2) {
                fetchMediaData(query);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            fetchMediaData('');
        });

        if (session('success')) {
            window.location.reload();
        }
    </script>

@endsection
