<table {{ $attributes->merge(['class' => 'table table-striped align-middle']) }}>
    <thead>
    <tr>
        {{ $head }}
    </tr>
    </thead>
    <tbody class="table-group-divider">
        {{ $body }}
    </tbody>
</table>

{{ $rows->onEachSide(1)->links() }}
