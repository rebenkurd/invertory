
@extends('dashboard')
@section('content')

<div class="content-wrapper container-xxl p-0">

    <div class="content-body">


        <div class="card">
            <div class="card-header">
                <h4>Reports</h4>

                <div class="btns">

                    <button type="button" onclick="history.back()" class="btn btn-primary mb-2">Back</button>
                    <button type="button" id="export-pdf" class="btn btn-primary mb-2">PDF</button>
                </div>
            </div>

            <div class="card-body">
                <table id="table-report" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Invoice No.</th>
                            <th>Invertory</th>
                            <th>Customer</th>
                            <th>Payment Status</th>
                            <th>Grand Total</th>
                            <th>Payment Due</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item )
                        <tr>
                            <td>{{ $item->sale_date }}</td>
                            <td>{{ $item->invoice_no }}</td>
                            <td>{{ $item->invertory->name }}</td>
                            <td>{{ $item->customer->name }}</td>
                            <td>{{ $item->pay_status }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->pay_due }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        </div>
    </div>


    <script>

$(document).ready(function() {
    $(document).ready(function() {
    $("#export-pdf").click(async function() {
                const { degrees, PDFDocument, rgb } = PDFLib;

                // Create a new PDF document
                const pdfDoc = await PDFDocument.create();

                // Create a new page
                const page = pdfDoc.addPage();

                // Add text to the page
                page.drawText('Exported Data', {
                    x: 50,
                    y: 750,
                    size: 12,
                    color: rgb(0, 0, 0),
                });

                // Add data from the table
                const data = [];
                $("#table-report tbody tr").each(function() {
                    var date = $(this).find("td:eq(0)").text();
                    var invoice = $(this).find("td:eq(1)").text();
                    var invertory = $(this).find("td:eq(2)").text();
                    var customer = $(this).find("td:eq(3)").text();
                    var pay_status = $(this).find("td:eq(4)").text();
                    var total = $(this).find("td:eq(5)").text();
                    var pay_due = $(this).find("td:eq(6)").text();
                    data.push([date, invoice, invertory,customer,pay_status,total,pay_due]);
                });

                let y = 700;
                data.forEach(row => {
                    page.drawText(row.join('   '), {
                        x: 50,
                        y,
                        size: 12,
                        color: rgb(0, 0, 0),
                    });
                    y -= 20;
                });

                // Serialize the PDF to bytes
                const pdfBytes = await pdfDoc.save();

                // Convert bytes to Blob
                const blob = new Blob([pdfBytes], { type: 'application/pdf' });

                // Trigger a download
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'exported.pdf';
                link.click();
            });
        });
    })
    </script>


@endsection
