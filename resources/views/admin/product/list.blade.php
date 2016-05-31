
@extends('admin.master')
@section('content')
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr align="center">
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Date</th>
            <th>Category</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php $stt = 0 ?>
        @foreach($data as $item)
            <?php $stt = $stt +1; ?>
            <tr class="odd gradeX" align="center">
                <td>{!! $stt !!}</td>
                <td>{!! $item['name'] !!}</td>
                <td>{!! number_format($item['price'],0,",",".")!!}VND</td>
                <td>
                    <?php
                    echo \Carbon\Carbon::createFromTimeStamp(strtotime($item['created_at']))->diffForHumans()
                    ?>

                </td>
                <td>
                    @if($item["cate_id"] == 0)
                        {!! "None" !!}
                    @else
                        <?php
                        $cc = $item['cate_id'];
                        $parent = DB::table('cates')->where('id', $item["cate_id"])->first();

                        echo $parent->name;
                        ?>

                    @endif

                </td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{!! URL::route('admin.product.getEdit', $item['id']) !!}"> Delete</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.product.getEdit', $item['id']) !!}">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
