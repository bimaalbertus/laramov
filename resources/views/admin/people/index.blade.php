@extends('layouts.admin')
@section('title', 'People CRUD')

@section('content')
    <div class="relative p-10">

        <x-alert type="error" :message="session('error')" id="error-alert" duration="10000" />
        <x-alert type="success" :message="session('success')" id="success-alert" duration="10000" />

        @include('admin.components.admin-header', [
            'name' => 'people',
            'title' => 'All people',
            'placeholder' => 'Search for people...',
            'search' => 'block',
            'formId' => 'delete-all-people',
            'formTitle' => 'Delete All People',
            'formMessage' => 'Are you sure want to delete all people?',
        ])

        <div id="resultsContainer">
            @include('admin.people.people-list', ['people' => $people])
        </div>
    </div>

@endsection

@section('script')
    <script>
        const searchInput = document.getElementById('default-search');
        const resultsContainer = document.getElementById('resultsContainer');

        function fetchPeopleData(query = '') {
            const formData = new FormData();
            formData.append('query', query);

            fetch('/admin/people/search', {
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
                fetchPeopleData('');
            } else if (query.length > 2) {
                fetchPeopleData(query);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            fetchPeopleData('');
        });

        if (session('success')) {
            window.location.reload();
        }
    </script>

@endsection
