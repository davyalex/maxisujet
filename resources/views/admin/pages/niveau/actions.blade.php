<!-- resources/views/admin/pages/niveau/actions.blade.php -->
<a href="#" data-toggle="modal" data-target="#modalEdit{{ $item->id }}">
    <i class="fas fa-edit fs-20" style="font-size: 20px;"></i>
</a>
<a href="#" class="delete" role="button" data-id="{{ $item->id }}">
    <i class="fas fa-trash text-danger" style="font-size: 20px;"></i>
</a>
