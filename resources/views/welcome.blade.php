<!DOCTYPE html>
<html>
    <head>
        <title>Coalition PHP Skill Test</title>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

        <!-- Twitter Bootstrap CDN -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>


        <script src="js/app.js"></script>
    </head>
    <body>
        <div class="container">
            <h1>Coalition PHP Skill Test</h1>
            <div class="row well">
                {!! Form::open(['url' => '/', 'id' => 'itemForm']) !!}
                <div class="form-group">
                    {!! Form::label('product', 'Product Name') !!}
                    {!! Form::text('product', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('qty', 'Quantity in Stock') !!}
                    {!! Form::text('qty', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('price', 'Price per Item') !!}
                    {!! Form::text('price', null, ['class' => 'form-control']) !!}
                </div>
                {!! Form::button('Add Item', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
            <div class="row well">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity in Stock</th>
                            <th>Price per Item</th>
                            <th>Datetime Submitted</th>
                            <th>Total Value</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                    <tr>
                        <td>Total Value Sum</td>
                        <td id="value-sum"></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </body>
</html>
