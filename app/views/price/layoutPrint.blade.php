<style>
    body{
        font-size: 10px;
        text-align: center;
    }
    .unlist{
        list-style: none;
        margin: 10px 0;
        padding: 0;
    }
    table{
        margin: 10px 0;
        width: 100%;
    }
    tfoot{
        border-top: 1px solid black;
        padding-top: 21px;
    }
    img{
        height: auto;
        width: 180px;
    }
    .text-center{
        text-align: center;
    }
    .text-right{
        text-align: right;
    }
    .barcode{
        width: 100%;
    }
    .barcode > div {
        margin: auto;
    }
    #footer{
        bottom: -20px;
        left: 0;
        position: fixed;
        right: 0;
    }
    #header{
        /*position: fixed;
        left: 0;
        right: 0;
        top: -20px;*/
    }
</style>


@include('price/partials/layoutBill')