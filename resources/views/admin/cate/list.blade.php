@extends('admin.master')
@section('content')

        <!-- Page Content -->
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
    <tr align="center">
        <th>ID</th>
        <th>Name</th>
        <th>Category Parent</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    @foreach($item as $i)
        <tr class="odd gradeX" align="center">
            <td>1</td>
            <td>{{$i['name']}}</td>
            <td>
                @if($i["parent_id"] == 0)
                    {!! "None" !!}
                @else
                    <?php
                        $cc = $i['parent_id'];
                    $parent = DB::table('cates')->where('id', $i["parent_id"])->first();

                    echo $parent->name;
                    ?>

                @endif

            </td>

            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick=" return confirmDelete('Ban co chac muon xoa ko?')" href="{!! URL::route('admin.cate.getDel',$i['id']) !!}"> Delete</a></td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.cate.getEdit',$i['id']) !!}">Edit</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection




