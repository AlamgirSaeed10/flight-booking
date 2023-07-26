@extends('layouts.app')
@section('content')
    <style>
        @media print {
            body {
                font-size: 12px;
            }

            .no-print {
                display: none;
            }
        }
    </style>

    <body>
        <div class="container">
            <div class="row no-print mb-4">
                <div class="col-12 text-center mt-4">
                    <button class="btn btn-primary" onclick="window.print()">Print</button>
                </div>
            </div>
            <div class="col-12 text-center">
                <img class="rounded me-2" width="300" src="{{ asset('assets/images/zis_travels.png') }}"
                    data-holder-rendered="true">
            </div>
            <h5 class="text-center mt-4 mb-2">Customer Invoice</h5>

            <div class="row mt-3">
                <h5 class="mb-2 p-2 bg-secondary text-white">Customer Details</h5>
                <div class="col-6">
                    <table width="100%">
                        <tr>
                            <td><strong>Cust. Name:</strong></td>
                            <td>{{ $customer_details[0]->CustomerName }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>{{ $customer_details[0]->CustomerEmail }}</td>
                        </tr>
                        <tr>
                            <td><strong>Cust. Address:</strong></td>
                            <td>{{ $customer_details[0]->CustomerAddress }}</td>
                        </tr>
                        <tr>
                            <td><strong>City & Post Code:</strong></td>
                            <td>{{ $customer_details[0]->CustomerCity }}, &nbsp;{{ $customer_details[0]->CustomerPostCode }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-6">
                    <table width="100%">
                        <tr>
                            <td><strong>Invoice #:</strong></td>
                            <td>{{ $customer_details[0]->InvoiceNo }}</td>
                        </tr>
                        <tr>
                            <td><strong>Invoice Date:</strong></td>
                            <td>{{ date('d F Y', strtotime($customer_details[0]->InvoiceDate)) }}</td>
                        </tr>
                        <tr>
                            <td><strong>AirLine Conf #:</strong></td>
                            <td>{{ $customer_details[0]->AirlineConfirmation }}</td>
                        </tr>
                        <tr>
                            <td><strong>Agent Name:</strong></td>
                            <td>{{ $customer_details[0]->AgentName }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mt-3">
                <h5 class="mb-2 p-2 bg-secondary text-white">Flight Details</h5>

                <div class="col-6">
                    <table width="100%">
                        <tr>
                            <td><strong>Dep. Airport:</strong></td>
                            <td>{{ $customer_details[0]->DepartureAirport }}</td>
                        </tr>
                        <tr>
                            <td><strong>Dep. Date:</strong></td>
                            <td>{{ date('d F Y', strtotime($customer_details[0]->DepartureDate)) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Cabin Class:</strong></td>
                            <td>{{ $customer_details[0]->CabinClass }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-6">
                    <table width="100%">
                        <tr>
                            <td><strong>Dest. Airport:</strong></td>
                            <td>{{ $customer_details[0]->DestinationAirport }}</td>
                        </tr>
                        <tr>
                            <td><strong>Return Date: </strong></td>
                            <td>{{ date('d F Y', strtotime($customer_details[0]->ReturnDate)) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Flight Type:</strong></td>
                            <td>{{ $customer_details[0]->FlightType }}</td>
                        </tr>
                    </table>
                </div>
            </div>





            <div class="row mt-3">
                <h5 class="mb-2 p-2 bg-secondary text-white">PNR Details</h5>

                <div class="col-6">
                    {{$customer_details[0]->PNRDetails}}

                </div>


            </div>

            <div class="row mt-3">
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="bg-secondary text-white">
                                <td><strong>SR #</strong></td>
                                <td class="text-center"><strong>Passenger Name</strong></td>
                                <td class="text-center"><strong>Type</strong></td>
                                <td class="text-center"><strong>Seat Qty</strong></td>
                                <td class="text-center"><strong>Ticket Price</strong></td>
                                <td class="text-center"><strong>Total</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $line_total = 0;
                                $total = 0;
                                $grand = 0;
                                $booking_fee = 0;
                            @endphp
                            @foreach ($passanger_details as $key => $value)
                                @php
                                    $booking_fee += $value->BookingFee;
                                    $line_total = $value->SeatQty * $value->SeatPrice;
                                    $total += $line_total;
                                    $grand = $booking_fee + $total;
                                @endphp
                                <tr>
                                    <td width="10%" class="text-center">{{ ++$key }}</td>
                                    <td width="40%" class="text-center">{{ $value->PassengerName }}
                                    </td>
                                    <td width="10%" class="text-center">{{ $value->PassengerType }}
                                    </td>
                                    <td width="15%" class="text-center">{{ $value->SeatQty }}</td>
                                    <td width="15%" class="text-center">{{ $value->SeatPrice }}</td>
                                    <td width="10%" class="text-center">{{ $line_total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <h5>Summary</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Total Price</th>
                                <td class="float-end">{{ $total }}</td>
                            </tr>
                            <tr>
                                <th>Total Booking Fee</th>
                                <td class="float-end">{{ $booking_fee }}</td>
                            </tr>
                            <tr>
                                <th>Grand Total</th>
                                <td class="float-end">{{ $grand }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row float-end">
                <div class="col-12 mt-4">
                    <p>________________________________</p>
                    <p class="float-end">Customer Name and Signature</p>
                </div>
            </div>

            <p style="page-break-after: always;">&nbsp;<br></p>

            <br><br>

            <div class="container">

                <h4 class="text-start">Booking Terms &amp; Conditions</h4>
                <p>Please read these carefully as the person making this booking (either for him selves or for any other
                    passenger) accepts all the below terms and
                    conditions of Zistravels.</p>
                <h5 class="text-start">DEPOSITS FOR HOLIDAY ARE NEITHER REFUNDABLE NOR CHANGEABLE (Terms &amp; Conditions
                    May Apply).</h5>
                <p>Unless Specified, All the deposits paid for flights and accommodation purchased/issued is non-refundable.
                    In case of cancellation or no show (Failure to arrive
                    or check-in on time) and non-changeable before or after departure (date change is not permitted). Once
                    holiday is reserved, bookings/tickets are non-transferable to any other person means that name changes
                    are not permitted.</p>
                <p>If you are reserving the flight or accommodation or both by making the advance partial payment (Initial
                    deposit) then please note that fare/taxes may
                    increase at any time without the prior notice. It means the price is not guaranteed unless the ticket is
                    issued because the airline/consolidator has the right to
                    increase the price due to any reason. In that case, we will not be liable and the passenger has to pay
                    the fare/tax difference. We always recommend you to
                    pay ASAP and get issue your flight tickets or holiday to avoid this situation. Furthermore, if you will
                    cancel your reservation due to any reason, then the paid
                    deposit(s) will be non-refundable.</p>
                <h5 class="text-start">CHECKING ALL FLIGHT DETIALS &amp; PASSENGER NAME(S)</h5>
                <p>It is your responsibility to check all the details are correct i.e. Passenger names (are same as
                    appearing on passport/travel docs), Travelling dates, Transit Time,
                    Origin &amp; Destination, Stop Over, Baggage Allowance, and other flight information. Once the ticket is
                    issued then no changes can be made, unless specified.</p>
                <h5 class="text-start">PASSPORT, VISA &amp; IMMIGRATION REQUIREMENTS</h5>
                <p>You are responsible for checking all these items like Passport, Visa (including Transit Visa), and other
                    immigration requirements. You must consult with the relevant Embassy/Consulate, well before the
                    departure time for up-to-date information as requirements may change from time to time. We regret we
                    cannot accept the liability of any transit visa and if you are refused to board the flight or could not
                    clear the immigration or any kind of failure in providing the information required like passport, visa
                    or other documents required by any airline, authority or country. We also recommend you that to check
                    this link <a
                        href="https://www.gov.uk/foreign-travel-advice">https://www.gov.uk/foreign-travel-advice</a> for
                    travel advice.</p>

                <h5 class="text-start">RECONFIRMING RETURN/ONWARD FLIGHTS</h5>
                <p>It is the traveler's responsibility to RECONFIRM your flights at least 72 hours before your departure
                    time either with your travel agent or the relevant Airline directly. The company will not be liable for
                    any additional costs due to your failure to reconfirm your flights.</p>
                <h5 class="text-start">SPECIAL REQUESTS AND MEDICAL PROBLEMS</h5>
                <p>If you have any special requests like meal preference, Seat Allocation and wheelchair request, etc,
                    please advise us at the time of issuance of the ticket. We will try our best to fulfill these bypassing
                    this request to the relevant airlines, but we cannot guarantee and failure to meet any special request
                    will not hold us liable for any claim.</p>

                <h5 class="text-start">Covid-19</h5>
                <p>Due to Covid-19, Additional entry requirements have been introduced which varies from country to country
                    and may be subject to change with short notice. You are responsible for checking and conforming with the
                    entry and exit requirements at their origins and destinations. Requirements may include proof of
                    negative PCR Covid-19 tests, temperature checks or completion of forms, etc.</p>
                <p>If the flight is affected due to Covid-19 then airline policies will be applied. To accommodate the
                    traveler, it is quite possible that the airline only offers the future date change or credit voucher
                    option instead of a refund. In that case, you must have to follow the airline rules and cannot demand a
                    refund. If a full refund is permitted, A admin fee (Per person) will be deducted as the service charges
                    and a refund can take up to 3 months. If the flight is operated by the airline and you decide not to
                    board the flight, then you will be ineligible for a refund. In this case (if your ticket is refundable)
                    then airline fare rules (cancellation fee) will be applied for processing the refunds.</p>

                <h5 class="text-start">VERY IMPORTANT:</h5>
                <p>Zistravels does not accept responsibility for any kind of loss if the airline fails to operate due to any
                    unforeseen circumstances like weather, war, natural disaster, pandemic, riots, strikes, etc. Passengers
                    will be solely responsible for that so it is highly recommended that separate travel and health
                    insurance must be arranged to protect you.</p>
                <p>We advise you to read our complete terms and conditions mentioned at <a
                        href="http://www.zistravels.co.uk/terms.php"> http://www.zistravels.co.uk/terms-and-conditions</a>
                    on our website.</p>
            </div>
        </div>
    </body>
@endsection
