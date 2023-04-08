@extends('layouts.app')

@section('content')
    <div class="container" id="Invoice">
        <div class="row d-print-none">
            <div class="col-md-6">
                <div class="col-12 col-lg-4 py-3 px-3">
                    {{$lang->text('Invoice')}}
                </div>
            </div>
        </div>
        <div class="invoice-wrap">
            <div class="invoice_header">
                <div class="left">
                    <h4>QuMarket</h4>
                    <div>ش علي بن اب طالب</div>
                    <div>قنا, قنا</div>
                </div>
            </div>
            <div class="invoice_info">
                <div class="left">
                    <div class="fw-bold">client:</div>
                    <div>ali</div>
                    <div>01011401555</div>
                </div>
                <div class="right">
                    <div class="fw-bold">Invoice number# &nbsp;&nbsp; 2150</div>
                    <div class="fw-bold">Date# &nbsp;&nbsp; 23/10/2023</div>
                </div>
            </div>
            <div class="invoice_body row">
                <table class="table">
                    <tbody>
                    <tr class="table-header">
                        <th>product</th>
                        <th style="width: 80px">price</th>
                        <th style="width: 40px">qty</th>
                        <th style="width: 60px">total</th>
                    </tr>
                    @isset($Cart)
                        @foreach($Cart->items as $index => $item)
                            <tr>
                                <td>{{$item->product->name}}</td>
                                <td style="width: 80px">{{CURRENCY_SYMBOL.$item->product->price}}</td>
                                <td style="width: 40px">{{$item->quantity}}</td>
                                <td style="width: 60px">{{CURRENCY_SYMBOL.$item->total}}</td>
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
            </div>
            <div class="invoice_footer">
                <div class="space"></div>
                <div class="total_invoice">
                    <div>
                        <div class="left fw-bold">subtotal:</div>
                        <div class="right">{{CURRENCY_SYMBOL.$Cart->getsubtotal()}}</div>
                    </div>
                    <div>
                        <div class="left fw-bold">Shipping:</div>
                        <div class="right">{{CURRENCY_SYMBOL.$Cart->getShoppingRate()}}</div>
                    </div>
                    <div>
                        <div class="left fw-bold">VAT:</div>
                        <div class="right">{{CURRENCY_SYMBOL.$Cart->getVat()}}</div>
                    </div>
                    <div style="background: #eeeeee">
                        <div class="left fw-bold">Discounts:</div>
                        <div class="right"></div>
                    </div>
                    @foreach($discounts as $discount)
                        <div>
                            <div class="left fw-bold">{{$discount['name']}}</div>
                            <div class="right">{{ '- ' . CURRENCY_SYMBOL.$discount['value']}}</div>
                        </div>
                    @endforeach
                    <div>
                        <div class="left fw-bold">Total:</div>
                        <div class="right">{{CURRENCY_SYMBOL.$Cart->getTotal()}}</div>
                    </div>
                </div>
            </div>
        </div>
@endsection


