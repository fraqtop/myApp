@extends('layouts.app')

@section('content')
    @if (Gate::allows('view-admin-panel'))
        <div class="dashboard-container">
            <table class="table table-dark">
                <thead>
                <tr>
                    <th>
                        functions available
                    </th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a href="#">Posts managing</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">Users managing</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">Spam log watching</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
@endsection
