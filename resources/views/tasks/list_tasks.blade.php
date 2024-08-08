<div class="container mt-3">
    @if ($tasks->isEmpty())
        <p class = 'notfound'>No tasks found</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>name</th>
                    <th>content</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $item)
                    <tr >
                        
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->content}}</td>
                        <td>{{ $item->status }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-links" style="display: flex; justify-content: center;">
            {{ $tasks->appends(request()->query())->links() }}
        </div>

    @endif
</div>
