@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')
    <form action="{{ route('admin.categories.store') }}" method="post">
        @csrf
        <div class="row gx-2 mb-4">
            <div class="col-4">
                <input type="text" name="name" class="form-control" placeholder="Add a category" autofocus>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-sm">Add</button>
            </div>
        </div>
        {{-- Error message here --}}
        @error ('name')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </form>
    <div class="row">
        <div class="col-7">
            <table class="table table-hover bg-white align-middle border table-sm text-secondary text-center">
                <thead class="small table-warning text-secondary">
                    <th>#</th>
                    <th>NAME</th>
                    <th>COUNT</th>
                    <th>LAST UPDATED</th>
                    <th>EDIT|DELETE</th>
                </thead>
                <tbody>
                    @forelse ($all_categories as $category)
                        <tr>
                            <td class="text-end">{{ $category->id }}</td>
                            <td class="text-decoration-none text-dark fw-bold">{{ $category->name }}</td>
                            <td>{{ $category->categoryPost->count() }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                                {{-- Edit Button --}}
                                <button class="btn btn-outline-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#edit-category-{{ $category->id }}" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                {{-- Delete Button --}}
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}" title="Delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                        {{-- Include a modal here --}}
                        @Include('admin.categories.modal.action')
                    @empty
                        <tr>
                            <td colspan="5" class="lead text-center text-muted">No Categories Found</td>
                        </tr>
                    @endforelse
                    <tr>
                        <td></td>
                        <td class="text-dark">
                            Uncategorized
                            <p class="xsmall mb-0 text-muted">Hidden posts are not included.</p>
                        </td>
                        <td>{{ $uncategorized_count }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $all_categories->links() }}
            </div>
        </div>
    </div>
@endsection