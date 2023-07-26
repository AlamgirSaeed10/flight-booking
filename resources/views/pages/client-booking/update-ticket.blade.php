@extends('layouts.header')
@section('content')

    @php
        $cities = json_decode(
            '[{"id":1,"city":"Adelaide - ADL"},{"id":2,"city":"Agana - GUM"},{"id":3,"city":"Brisbane - BNE"},{"id":4,"city":"Christchurch - CHC"},{"id":5,"city":"Dunedin - DUD"},{"id":6,"city":"Georgetown - GEO"},{"id":7,"city":"Gold-Coast - OOL"},{"id":8,"city":"Hamilton (BDA)"},{"id":9,"city":"Kathmandu - KTM"},{"id":10,"city":"La Paz - LPB"},{"id":11,"city":"Mexico City - AZP"},{"id":12,"city":"Nelson - NSN"},{"id":13,"city":"Panama-City - PTY"},{"id":14,"city":"Papeete - PPT"},{"id":15,"city":"Queenstown - ZQN"},{"id":16,"city":"Rio de Janeiro - GIG"},{"id":17,"city":"Sao Paulo - GRU"},{"id":18,"city":"St Georges - GND"},{"id":19,"city":"Toronto - YYZ"},{"id":20,"city":"Vancouver - YVR"},{"id":21,"city":"Abidjan - ABJ"},{"id":22,"city":"Abuja - ABV"},{"id":23,"city":"ACCRA - ACC"},{"id":24,"city":"Addis Ababa - ADD"},{"id":25,"city":"Agadir - AGA"},{"id":26,"city":"Algiers - ALG"},{"id":27,"city":"Antananarivo - TNR"},{"id":28,"city":"Antigua - ANU"},{"id":29,"city":"Asmara - ASM"},{"id":30,"city":"Asuncion - ASU"},{"id":31,"city":"Auckland - AKL"},{"id":32,"city":"Bahrain - BAH"},{"id":33,"city":"Bamako - BKO"},{"id":34,"city":"Bandar Seri Begawan"},{"id":35,"city":"BANGKOK-BKK"},{"id":36,"city":"Banjul - BJL"},{"id":37,"city":"Beijing - BJS"},{"id":38,"city":"Beira - BEW"},{"id":39,"city":"Benghazi - BEN"},{"id":40,"city":"Bloemfontein - BFN"},{"id":41,"city":"Bogota - BOG"},{"id":42,"city":"Boston - BOS"},{"id":43,"city":"Brasilia - BSB"},{"id":44,"city":"Bridgetown - BGI"},{"id":45,"city":"Buenos-Aires - BUE"},{"id":46,"city":"Bujumbura - BJM"},{"id":47,"city":"Cairns - CNS"},{"id":48,"city":"Cali - CLO"},{"id":49,"city":"Canberra - CBR"},{"id":50,"city":"Cape Town - CPT"},{"id":51,"city":"Casablanca - CMN"},{"id":52,"city":"Cebu - CEB"},{"id":53,"city":"Chittagong - CGP"},{"id":54,"city":"Conakry - CKY"},{"id":55,"city":"Cordoba - COR"},{"id":56,"city":"Dakar - DKR"},{"id":57,"city":"Darwin - DRW"},{"id":58,"city":"Denpasar - DPS"},{"id":59,"city":"Dhaka - DAC"},{"id":60,"city":"Djibouti - JIB"},{"id":61,"city":"Douala - DLA"},{"id":62,"city":"Dubai - DXB"},{"id":63,"city":"Durban - DUR"},{"id":64,"city":"East London - ELS"},{"id":65,"city":"Essaouira - ESU"},{"id":66,"city":"Fez - FEZ"},{"id":67,"city":"Freetown - FNA"},{"id":68,"city":"Gaborone - GBE"},{"id":69,"city":"George-Town-KY\u00c2\u00a0"},{"id":70,"city":"Goa - GOI"},{"id":71,"city":"Guayaquil - GYE"},{"id":72,"city":"Hargeisa - HGA"},{"id":73,"city":"Ho Chi Minh City - S"},{"id":74,"city":"Hong Kong - HKG"},{"id":75,"city":"Jeddah - JED"},{"id":76,"city":"Johannesburg - JNB"},{"id":77,"city":"Kabul - KBL"},{"id":78,"city":"Kano - KAN"},{"id":79,"city":"Karachi - KHI"},{"id":80,"city":"Kigali - KGL"},{"id":81,"city":"Kimberley - KIM"},{"id":82,"city":"Kingston - KIN"},{"id":83,"city":"Kisumu - KIS"},{"id":84,"city":"Kuala Lumpur - KUL"},{"id":85,"city":"LAGOS - LOS"},{"id":86,"city":"Lahore - LHE"},{"id":87,"city":"Las Vegas - LAS"},{"id":88,"city":"Liberia - LIR"},{"id":89,"city":"Libreville - LBV"},{"id":90,"city":"Lilongwe - LLW"},{"id":91,"city":"Lima - LIM"},{"id":92,"city":"Luanda - LAD"},{"id":93,"city":"Maiquetia - CCS"},{"id":94,"city":"Malabo - SSG"},{"id":95,"city":"Malindi - MYD"},{"id":96,"city":"Manila - MNL"},{"id":97,"city":"Maputo - MPM"},{"id":98,"city":"Marrakech - RAK"},{"id":99,"city":"Maseru - MSU"},{"id":100,"city":"Mombasa - MBA"},{"id":101,"city":"Monrovia - ROB"},{"id":102,"city":"Montevideo - MVD"},{"id":103,"city":"Moroni - YVA"},{"id":104,"city":"Mumbai - BOM"},{"id":105,"city":"Nadi - NAN"},{"id":106,"city":"Nairobi - NBO"},{"id":107,"city":"Napier - NPE"},{"id":108,"city":"Nassau - NAS"},{"id":109,"city":"NDjamena - NDJ"},{"id":110,"city":"New York - JFK"},{"id":111,"city":"Niamey - NIM"},{"id":112,"city":"Nouakchott - NKC"},{"id":113,"city":"Noumea - GEA"},{"id":114,"city":"Ouarzazate - OZZ"},{"id":115,"city":"Oujda - OUD"},{"id":116,"city":"Paramaribo - PBM"},{"id":117,"city":"Perth - PER"},{"id":118,"city":"Philipsburg - SXM"},{"id":119,"city":"Phnom Penh - PNH"},{"id":120,"city":"Port Harcourt - PHC\r"},{"id":121,"city":"Port louis - MRU"},{"id":122,"city":"Quebec - YQB"},{"id":123,"city":"Quito - UIO"},{"id":124,"city":"Wellington - WLG"},{"id":125,"city":"Rabat - RBA"},{"id":126,"city":"Rarotonga - RAR"},{"id":127,"city":"Rodrigues Island - R"},{"id":128,"city":"Salvador - SSA"},{"id":129,"city":"San Francisco - SFO\r"},{"id":130,"city":"San-Salvador - SAL"},{"id":131,"city":"Santa Cruz - SRZ"},{"id":132,"city":"Santiago - SCL"},{"id":133,"city":"Seoul - ICN"},{"id":134,"city":"Siem Reap - REP"},{"id":135,"city":"Singapore - SIN"},{"id":136,"city":"St-Lucia - UVF"},{"id":137,"city":"Sydney - SYD"},{"id":138,"city":"Taipei - TPE"},{"id":139,"city":"Tangier - TNG"},{"id":140,"city":"Tokyo - HND"},{"id":141,"city":"Tripoli - TIP"},{"id":142,"city":"Walvis Bay - WVB"},{"id":143,"city":"Washington - DCA"},{"id":144,"city":"Windhoek - WDH"},{"id":145,"city":"Yaounde - NSI"},{"id":146,"city":"Aalborg - AAL"},{"id":147,"city":"Aalesund - AES"},{"id":148,"city":"Alicante - ALC"},{"id":149,"city":"Alta - ALS"},{"id":150,"city":"Amsterdam - AMS"},{"id":151,"city":"Arad - ARW"},{"id":152,"city":"Athens - ATH"},{"id":153,"city":"Bacau - BCM"},{"id":154,"city":"Baia Mare - BAY"},{"id":155,"city":"Baku - BAK"},{"id":156,"city":"Barcelona - BCM"},{"id":157,"city":"Bergen - BGO"},{"id":158,"city":"Bergerac - EGC"},{"id":159,"city":"Billund - BLL"},{"id":160,"city":"Bodo - BOO"},{"id":161,"city":"Bordeaux - BOD"},{"id":162,"city":"Bourgas - DOJ"},{"id":163,"city":"Bratislava - BTS"},{"id":164,"city":"Brno - BRQ"},{"id":165,"city":"Brussels - BRU"},{"id":166,"city":"Bucharest - BBU"},{"id":167,"city":"Budapest - BUD"},{"id":168,"city":"Cagliari - CAG"},{"id":169,"city":"Chisinau - KIV"},{"id":170,"city":"Cologne - CGN"},{"id":171,"city":"Copenhagen - CPH"},{"id":172,"city":"Dortmund - DTM"},{"id":173,"city":"Dublin - DUB"},{"id":174,"city":"Dubrovnik - DBV"},{"id":175,"city":"Dusseldorf - DUS"},{"id":176,"city":"EaSt london-ELS"},{"id":177,"city":"Eindhoven - EIN"},{"id":178,"city":"Entebbe -Ebb"},{"id":179,"city":"Ercan - ECN"},{"id":180,"city":"Florence - FLR"},{"id":181,"city":"Frankfurt - FRA"},{"id":182,"city":"Gdansk - GDN"},{"id":183,"city":"Gothenburg - GOT"},{"id":184,"city":"Graz - GRZ"},{"id":185,"city":"Hamburg - HAM"},{"id":186,"city":"Hanover - HAJ"},{"id":187,"city":"Harare-Hre"},{"id":188,"city":"Haugesund - HAU"},{"id":189,"city":"Helsinki - HEL"},{"id":190,"city":"Ibiza - IBZ"},{"id":191,"city":"Innsbruck - INN"},{"id":192,"city":"Kajaani - KAJ"},{"id":193,"city":"kano-Kan"},{"id":194,"city":"Katowice - KTW"},{"id":195,"city":"Kaunas - KUN"},{"id":196,"city":"Kefalonia - EFL"},{"id":197,"city":"Knock - NOC"},{"id":198,"city":"Kos - KGS"},{"id":199,"city":"Kosice - KSC"},{"id":200,"city":"Krakow - KRK"},{"id":201,"city":"Kuopio - KUO"},{"id":202,"city":"La Rochelle - LRH"},{"id":203,"city":"Larnaca - LCA"},{"id":204,"city":"Las Palmas - LPA"},{"id":205,"city":"Linz - LNZ"},{"id":206,"city":"Lisbon - LIS"},{"id":207,"city":"Ljubljana - LJU"},{"id":208,"city":"Lusaka -Lun"},{"id":209,"city":"Luxembourg - LUX"},{"id":210,"city":"Madrid - MAD"},{"id":211,"city":"Mikonos - JMK"},{"id":212,"city":"Milan - LIN"},{"id":213,"city":"Naples - NAP"},{"id":214,"city":"Nice - NCE"},{"id":215,"city":"Olbia - OLB"},{"id":216,"city":"Oslo - OSL"},{"id":217,"city":"Ostrava - OSR"},{"id":218,"city":"Oulu - OUL"},{"id":219,"city":"Palermo - PMO"},{"id":220,"city":"Paphos - PFO"},{"id":221,"city":"Paris - CDE"},{"id":222,"city":"Poznan - POZ"},{"id":223,"city":"Prague - PRG"},{"id":224,"city":"Pula - PUY"},{"id":225,"city":"Rennes - RMS"},{"id":226,"city":"Reykjavik- KEF"},{"id":227,"city":"Rhodes - RHO"},{"id":228,"city":"Riga - RIX"},{"id":229,"city":"Rome - FCO"},{"id":230,"city":"Rotterdam - RTM"},{"id":231,"city":"Rovaniemi - RVN"},{"id":232,"city":"Rzeszow - RZE"},{"id":233,"city":"Samos - SMI"},{"id":234,"city":"Shannon - SNN"},{"id":235,"city":"Sibiu - SBZ"},{"id":236,"city":"Skopje - SKP"},{"id":237,"city":"Sofia - SOF"},{"id":238,"city":"Split - SPU"},{"id":239,"city":"Stuttgart - STR"},{"id":240,"city":"Tallinn - TTL"},{"id":241,"city":"Tampere - TMP"},{"id":242,"city":"Tbilisi - TBS"},{"id":243,"city":"Tenerife - TFN"},{"id":244,"city":"Thessaloniki - SKG"},{"id":245,"city":"Thira - JTR"},{"id":246,"city":"Tirana - TIA"},{"id":247,"city":"Toulouse - TLS"},{"id":248,"city":"Trondheim - TRD"},{"id":249,"city":"Varna - VAR"},{"id":250,"city":"Venice - VCE"},{"id":251,"city":"Verona - VRN"},{"id":252,"city":"Vienna - VIE"},{"id":253,"city":"Vilnius - VNO"},{"id":254,"city":"Warsaw - WAW"},{"id":255,"city":"Wroclaw - WRO"},{"id":256,"city":"Yerevan - EVN"},{"id":257,"city":"Zadar - ZAD"},{"id":258,"city":"Zagreb - ZAG"},{"id":259,"city":"Dar es Salaam"},{"id":273,"city":"Islamabad - ISB"},{"id":274,"city":"Abu Dhabi - AUH"},{"id":275,"city":"Amritsar - ATQ"},{"id":276,"city":"Cairo - CAI"},{"id":277,"city":"Colombo - CMB"},{"id":278,"city":"Doha - DOH"},{"id":279,"city":"Delhi - DEL"},{"id":280,"city":"Guangzhou - CAN"},{"id":281,"city":"Hyderabad - HYD"},{"id":282,"city":"Istanbol - IST"},{"id":283,"city":"Kuwait - KWI"},{"id":284,"city":"Zurich - ZRH"},{"id":285,"city":"Kinhasa - FIH"},{"id":286,"city":"Quetta - UET"},{"id":287,"city":"Sialkot - SKT"},{"id":288,"city":"Faisalabad - LYP"},{"id":289,"city":"Multan - MUX"},{"id":291,"city":"Peshawar - PEW"}]', true);
    @endphp


    <script
        src="https://cdn.tiny.cloud/1/8ocium3ymud15bb8sswaevn9jxk0jo821fjmyfwj7yml17bw/tinymce/6/tinymce.min.js"></script>
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18 text-danger">Update Pending Booking #
                        {{ $customer_details[0]->InvoiceNo }}</h4>
                    <div class="page-title-right">
                        <a href="{{ route('booking-flight') }}" class="btn btn-primary waves-effect waves-light btn-sm">
                            <i class="bx bx-user-plus"></i> Add Booking </a>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Display Success Message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-info">Booking Details <span class="text-success"></span></h5>
                                <form action="{{route('update-tickets', $customer_details[0]->InvoiceNo)}}"
                                      method="POST">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" class="form-control" name="CustomerID"
                                               value="{{ $customer_details[0]->CustomerID }}">
                                        <div class="col-md-3">
                                            <label class="control-label text-left">Invoice Date</label>
                                            <input type="date" class="form-control" name="InvoiceDate"
                                                   value="{{ date('Y-m-d', strtotime($customer_details[0]->InvoiceDate)) }}">

                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label text-left"> Booking Date</label>
                                            <input type="date" class="form-control" name="BookingDate"
                                                   value="{{ date('Y-m-d', strtotime($customer_details[0]->BookingDate)) }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label text-left"> Services</label>
                                            <br>
                                            <div class="form-check-inline">
                                                <input type="checkbox" name="flightcheck" class="servicecheck"
                                                       id="flightcheck"
                                                       checked="">
                                                <label for="flightcheck">Flight</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <h5 class="text-info"> Customer Contacts</h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Full Name</label>
                                            <input type="text" class="form-control" name="CustomerName"
                                                   value="{{ $customer_details[0]->CustomerName }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Phone #</label>
                                            <input type="text" class="form-control" name="CustomerPhone"
                                                   value="{{ $customer_details[0]->CustomerPhone }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Source</label>
                                            <select name="BookingSource" class="form-control" required>
                                                <option value="Select Booking Source"
                                                    {{ $customer_details[0]->BookingSource === 'Select Booking Source' ? 'selected' : '' }}>
                                                    Select Booking Source
                                                </option>
                                                <option value="Newsletter"
                                                    {{ $customer_details[0]->BookingSource === 'Newsletter' ? 'selected' : '' }}>
                                                    Newsletter
                                                </option>
                                                <option value="Google"
                                                    {{ $customer_details[0]->BookingSource === 'Google' ? 'selected' : '' }}>
                                                    Google
                                                </option>
                                                <option value="Bing"
                                                    {{ $customer_details[0]->BookingSource === 'Bing' ? 'selected' : '' }}>
                                                    Bing
                                                </option>
                                                <option value="SMS"
                                                    {{ $customer_details[0]->BookingSource === 'SMS' ? 'selected' : '' }}>
                                                    SMS
                                                </option>
                                                <option value="Friend"
                                                    {{ $customer_details[0]->BookingSource === 'Friend' ? 'selected' : '' }}>
                                                    Friend
                                                </option>
                                                <option value="Repeat"
                                                    {{ $customer_details[0]->BookingSource === 'Repeat' ? 'selected' : '' }}>
                                                    Repeat
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Email</label>
                                            <input type="email" class="form-control" name="CustomerEmail"
                                                   value="{{ $customer_details[0]->CustomerEmail }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Address</label>
                                            <input type="text" class="form-control" name="CustomerAddress"
                                                   value="{{ $customer_details[0]->CustomerAddress }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> City</label>
                                            <input type="text" class="form-control" name="CustomerCity"
                                                   value="{{ $customer_details[0]->CustomerCity }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> PostCode</label>
                                            <input type="text" class="form-control" name="CustomerPostCode"
                                                   value="{{ $customer_details[0]->CustomerPostCode }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="text-info"> Receipt Details</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label text-left"> Paying By</label>
                                            <select class="form-control" name="PayingBy">
                                                <option value="Select Payment Party"
                                                    {{ $recipt_details[0]->PayingBy == 'Select Payment Party' ? 'selected' : '' }}>
                                                    Select Payment Party
                                                </option>
                                                <option value="Self"
                                                    {{ $recipt_details[0]->PayingBy == 'Self' ? 'selected' : '' }}>Self
                                                </option>
                                                <option value="Third Party"
                                                    {{ $recipt_details[0]->PayingBy == 'Third Party' ? 'selected' : '' }}>
                                                    Third
                                                    Party
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label text-left"> Due Date</label>
                                            <input type="date" class="form-control" name="PaymentDueDate"
                                                   value="{{ date('Y-m-d', strtotime($recipt_details[0]->PaymentDueDate)) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label text-left"> Recipt Mode</label>
                                            <select class="form-control" name="ReciptMode" id="card-type">
                                                <option value="Cash"
                                                    {{ $recipt_details[0]->ReciptMode === 'Cash' ? 'selected' : '' }}>
                                                    Cash
                                                </option>
                                                <option value="Bank Transfer"
                                                    {{ $recipt_details[0]->ReciptMode === 'Bank Transfer' ? 'selected' : '' }}>
                                                    Bank Transfer
                                                </option>
                                                <option value="Credit Card"
                                                    {{ $recipt_details[0]->ReciptMode === 'Credit Card' ? 'selected' : '' }}>
                                                    Credit Card
                                                </option>
                                                <option value="Debit Card"
                                                    {{ $recipt_details[0]->ReciptMode === 'Debit Card' ? 'selected' : '' }}>
                                                    Debit Card
                                                </option>
                                                <option value="American Express"
                                                    {{ $recipt_details[0]->ReciptMode === 'American Express' ? 'selected' : '' }}>
                                                    American Express
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <span class="card_details card-details-section"
                                          style="display: {{$recipt_details[0]->ReciptMode === 'Credit Card' || $recipt_details[0]->ReciptMode === 'Debit Card' ? 'block' : 'none'}}">
                                            <div class="row mt-3">
                                                <div class="col-md-3">
                                                    <label class="control-label text-left"> Card Holder Name</label>
                                                    <input type="text" class="form-control" name="CardHolderName"
                                                           value="{{ $recipt_details[0]->CardHolderName }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label text-left"> Card #</label>
                                                    <input type="text" class="form-control" name="CardNo"
                                                           value="{{ $recipt_details[0]->CardNo }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label text-left"> Expiry Date</label>
                                                    <input type="text" class="form-control" name="CardExpiry"
                                                           value="{{ $recipt_details[0]->CardExpiry }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label text-left"> CVC</label>
                                                    <input type="text" class="form-control" name="CVV"
                                                           value="{{ $recipt_details[0]->CVV }}">
                                                </div>
                                            </div>
                                        </span>

                                    <ul class="nav nav-tabs mt-3" id="detailtab" data-bs-toggle="tabs">
                                        <li class="nav-item flight">
                                            <a class="nav-link active show" data-bs-toggle="tab" href="#flight"> Flight
                                                Details</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mb-3" id="detailsTabs">
                                        <div class="card" id="flight">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
                                                        <label for="FlightSupplier" class="form-label">Flight Supplier
                                                            <span
                                                                class="text-danger"> *</span></label>
                                                        <select name="FlightSupplier" class="form-control" required="">
                                                            <option value="">Select Booking Supplier</option>
                                                            <option
                                                                value="Brightsun Travels" {{$customer_details[0]->FlightSupplier === 'Brightsun Travels'?'selected':'' }}>
                                                                Brightsun Travels
                                                            </option>
                                                            <option
                                                                value="Euro Africa Travels" {{$customer_details[0]->FlightSupplier === 'Euro Africa Travels'?'selected':'' }}>
                                                                Euro Africa Travels
                                                            </option>
                                                            <option
                                                                value="Skylords Travels" {{$customer_details[0]->FlightSupplier === 'Skylords Travels'?'selected':'' }}>
                                                                Skylords Travels
                                                            </option>
                                                            <option
                                                                value="Citibond Travels" {{$customer_details[0]->FlightSupplier === 'Citibond Travels'?'selected':'' }}>
                                                                Citibond Travels
                                                            </option>
                                                            <option
                                                                value="Greaves Travels" {{$customer_details[0]->FlightSupplier === 'Greaves Travels'?'selected':'' }}>
                                                                Greaves Travels
                                                            </option>
                                                            <option
                                                                value="Airline" {{$customer_details[0]->FlightSupplier === 'Airline'?'selected':'' }}>
                                                                Airline
                                                            </option>
                                                            <option
                                                                value="Master Fare" {{$customer_details[0]->FlightSupplier === 'Master Fare'?'selected':'' }}>
                                                                Master Fare
                                                            </option>
                                                            <option
                                                                value="Med View Airline" {{$customer_details[0]->FlightSupplier === 'Med View Airline'?'selected':'' }}>
                                                                Med View Airline
                                                            </option>
                                                            <option
                                                                value="Global Travel" {{$customer_details[0]->FlightSupplier === 'Global Travel'?'selected':'' }}>
                                                                Global Travel
                                                            </option>
                                                            <option
                                                                value="Cab 101" {{$customer_details[0]->FlightSupplier === 'Cab 101'?'selected':'' }}>
                                                                Cab 101
                                                            </option>
                                                            <option
                                                                value="Hotel 101" {{$customer_details[0]->FlightSupplier === 'Hotel 101'?'selected':'' }}>
                                                                Hotel 101
                                                            </option>
                                                            <option
                                                                value="E-Visa" {{$customer_details[0]->FlightSupplier === 'E-Visa'?'selected':'' }}>
                                                                E-Visa
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                                        <label class="control-label text-left"> Sup Ref</label>
                                                        <input type="text" class="form-control" name="SupplierRef"
                                                               value="{{ $customer_details[0]->SupplierRef }}">
                                                    </div>
                                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                                        <label class="control-label text-left"> Sup's Agent</label>
                                                        <input type="text" class="form-control" name="SupplierAgent"
                                                               value="{{ $customer_details[0]->SupplierAgent }}">
                                                    </div>
                                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                                        <label class="control-label text-left"> Airline Conf.</label>
                                                        <input type="text" class="form-control"
                                                               name="AirlineConfirmation"
                                                               value="{{ $customer_details[0]->AirlineConfirmation }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                                        <label class="control-label text-left"> Dept. Airport</label>

                                                        <input list="DepartureAirport" class="form-control"
                                                               name="DepartureAirport"/>
                                                        <datalist id="DepartureAirport">
                                                            @foreach ($cities as $city)
                                                                <option
                                                                    value="{{ $customer_details[0]->DepartureAirport }}" {{ $city['city'] == $customer_details[0]->DepartureAirport ? 'selected' : '' }}>
                                                                    {{ $city['city'] }}</option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                                        <label class="control-label text-left"> Dest. Airport</label>

                                                        <input list="DestinationAirport" class="form-control"
                                                               name="DestinationAirport" id="DestSearch"/>
                                                        <datalist id="DestinationAirport">
                                                            @foreach ($cities as $city)
                                                                <option
                                                                    value="{{ $customer_details[0]->DestinationAirport }}" {{ $city['city'] == $customer_details[0]->DestinationAirport ? 'selected' : '' }}>
                                                                    {{ $city['city'] }}</option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                                        <label class="control-label text-left"> Via. Arpt.</label>
                                                        <input type="text" class="form-control" name="FlightVia"
                                                               value="{{ $customer_details[0]->FlightVia }}">
                                                    </div>
                                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                                        <label class="control-label text-left"> Flight Type</label>
                                                        <select class="form-select" name="FlightType" required="">
                                                            <option selected="">Select Flight Type</option>
                                                            <option
                                                                value="Return" {{$customer_details[0]->FlightType=== 'Return' ? 'selected':''}}>
                                                                Return
                                                            </option>
                                                            <option
                                                                value="One Way" {{$customer_details[0]->FlightType=== 'One Way'?'selected':''}}>
                                                                One Way
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                                        <label class="control-label text-left"> Dept Date</label>
                                                        <input type="date" class="form-control" name="DepartureDate"
                                                               value="{{ date('Y-m-d', strtotime($customer_details[0]->DepartureDate)) }}">
                                                    </div>
                                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                                        <label class="control-label text-left"> Rtrn. Date</label>
                                                        <input type="date" class="form-control" name="ReturnDate"
                                                               value="{{ date('Y-m-d', strtotime($customer_details[0]->ReturnDate)) }}">
                                                    </div>
                                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                                        <label class="control-label text-left"> Flight Class</label>
                                                        <input type="text" class="form-control" name="CabinClass"
                                                               value="{{ $customer_details[0]->CabinClass }}">
                                                    </div>
                                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                                        <label class="control-label text-left"> GDS</label>
                                                        <input type="text" class="form-control" name="FlightGDS"
                                                               value="{{ $customer_details[0]->FlightGDS }}">
                                                    </div>
                                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                                        <label class="control-label text-left"> Airline</label>
                                                        <input type="text" class="form-control" name="Airline"
                                                               value="{{ $customer_details[0]->Airline }}">
                                                    </div>
                                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                                        <label class="control-label text-left"> PNR Expiry</label>
                                                        <input type="date" class="form-control" name="PNRExpiry"
                                                               value="{{ date('Y-m-d', strtotime($customer_details[0]->PNRExpiry)) }}">
                                                    </div>
                                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                                        <label class="control-label text-left"> Fare Expiry</label>
                                                        <input type="date" class="form-control" name="FareExpiry"
                                                               value="{{ date('Y-m-d', strtotime($customer_details[0]->FareExpiry)) }}">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                                                        <label class="control-label text-left"> PNR</label>
                                                        <textarea class="form-control"
                                                                  name="PNRDetails">{!! isset($customer_details[0]->PNRDetails) ? $customer_details[0]->PNRDetails : '' !!}</textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="control-label text-left"> Ticket Details:</label>
                                                        <textarea class="form-control"
                                                                  name="TicketDetail">{!! isset($customer_details[0]->TicketDetail) ? $customer_details[0]->TicketDetail : '' !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $totalAmount = $ticket_cost[0]->BasicAmount + $ticket_cost[0]->TaxAmount + $ticket_cost[0]->APCAmount + $ticket_cost[0]->Misc;
                                        @endphp
                                        <div class="card mb-3">
                                            <div id="costSection" class="card-body  booking-bg-green">
                                                <div class="row m-0">
                                                    <div class="col-md-12 nopadding">
                                                        <h5 class="text-info mb-2"> Ticket Cost </h5>
                                                    </div>
                                                    <div class="col-md-6" style="border-right: thin solid #000000;">
                                                        <div class="row">
                                                            <div class="col-md-12 nopadding">
                                                                <h6 class="card-title text-cyan">I) Payable to Supplier:
                                                                    <strong
                                                                        class="text-success"><span
                                                                            id="payableAmount">{{ number_format($totalAmount, 2) }}</span></strong>
                                                                </h6>
                                                            </div>
                                                            <div class="col-md-3 nopadding">
                                                                <label class="control-label text-left">
                                                                    <strong>Basic</strong>
                                                                </label>
                                                                <input type="number" class="form-control payable-input"
                                                                       name="BasicAmount"
                                                                       value="{{ number_format($ticket_cost[0]->BasicAmount, 2) }}"
                                                                       onkeyup="calculatePayableTotal()">
                                                            </div>
                                                            <div class="col-md-3 nopadding">
                                                                <label class="control-label text-left">
                                                                    <strong>Tax</strong>
                                                                </label>
                                                                <input type="number" class="form-control payable-input"
                                                                       name="TaxAmount"
                                                                       value="{{ number_format($ticket_cost[0]->TaxAmount, 2) }}"
                                                                       onkeyup="calculatePayableTotal()">
                                                            </div>
                                                            <div class="col-md-3 nopadding">
                                                                <label class="control-label text-left">
                                                                    <strong>APC</strong>
                                                                </label>
                                                                <input type="number" class="form-control payable-input"
                                                                       name="ACPAmount"
                                                                       value="{{ number_format($ticket_cost[0]->APCAmount, 2) }}"
                                                                       onkeyup="calculatePayableTotal()">
                                                            </div>
                                                            <div class="col-md-3 nopadding">
                                                                <label class="control-label text-left">
                                                                    <strong>Misc.</strong>
                                                                </label>
                                                                <input type="number" class="form-control payable-input"
                                                                       name="Misc"
                                                                       value="{{ number_format($ticket_cost[0]->Misc, 2) }}"
                                                                       onkeyup="calculatePayableTotal()">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php
                                                        $add_total = $ticket_cost[0]->BankFee + $ticket_cost[0]->CardFee + $ticket_cost[0]->APCAmount + $ticket_cost[0]->Misc;
                                                    @endphp
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5 class="card-title text-cyan">II) Additional
                                                                    Expenses: <strong
                                                                        class="text-success"><span
                                                                            id="additionalAmount">{{ number_format($add_total, 2) }}</span></strong>
                                                                </h5>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="control-label text-left">
                                                                    <strong>Bank</strong>
                                                                </label>
                                                                <input type="number"
                                                                       class="form-control additional-input"
                                                                       name="BankFee"
                                                                       value="{{ number_format($ticket_cost[0]->BankFee, 2) }}"
                                                                       onkeyup="calculateAdditionalTotal()">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="control-label text-left">
                                                                    <strong>Card</strong>
                                                                </label>
                                                                <input type="number"
                                                                       class="form-control additional-input"
                                                                       name="CardFee"
                                                                       value="{{ number_format($ticket_cost[0]->CardFee, 2) }}"
                                                                       onkeyup="calculateAdditionalTotal()">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="control-label text-left">
                                                                    <strong>APC</strong>
                                                                </label>
                                                                <input type="number"
                                                                       class="form-control additional-input"
                                                                       name="APCAmount"
                                                                       value="{{ number_format($ticket_cost[0]->APCAmount, 2) }}"
                                                                       onkeyup="calculateAdditionalTotal()">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="control-label text-left">
                                                                    <strong>Misc.</strong>
                                                                </label>
                                                                <input type="number"
                                                                       class="form-control additional-input"
                                                                       name="Misc"
                                                                       value="{{ number_format($ticket_cost[0]->Misc, 2) }}"
                                                                       onkeyup="calculateAdditionalTotal()">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="card mb-3">
                                            <div class="card-header bg-dark">
                                                <h4 class="card-title text-white">Receipts from Customer</h4>
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-striped mb-0 border-dark">
                                                        <thead class="bg-dark text-white ">
                                                        <tr>
                                                            <th class="text-center">Paid By</th>
                                                            <th class="text-center">Receipt Date</th>
                                                            <th class="text-center">Paid By</th>
                                                            <th class="text-center">£ Received</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($recipt_details as $key => $value)
                                                            <tr class="border-dark">
                                                                <input type="hidden" class="form-control"
                                                                       name="ReciptID[]"
                                                                       value="{{ $value->ReciptID }}">
                                                                <td class="text-center">
                                                                    <select class="form-control" name="PayingBy[]">
                                                                        <option
                                                                            value="Self"{{ $value->PayingBy === 'Self' ? ' selected' : '' }}>
                                                                            Self
                                                                        </option>
                                                                        <option
                                                                            value="Third Party"{{ $value->PayingBy === 'Third Party' ? ' selected' : '' }}>
                                                                            Third Party
                                                                        </option>
                                                                    </select>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="date" class="form-control"
                                                                           name="PaymentDate[]"
                                                                           value="{{ $value->PaymentDate !== null ?date('Y-m-d',strtotime($value->PaymentDate)) :'' }}">
                                                                </td>
                                                                <td class="text-center">
                                                                    <select class="form-control" name="ReciptMode[]">
                                                                        <option
                                                                            value="Cash"{{ $value->ReciptMode === 'Cash' ? 'selected' : '' }}>
                                                                            Cash
                                                                        </option>
                                                                        <option
                                                                            value="Card"{{ $value->ReciptMode === 'Card' ? ' selected' : '' }}>
                                                                            Card
                                                                        </option>
                                                                        <option
                                                                            value="Bank Transfer"{{ $value->ReciptMode === 'Bank Transfer' ? ' selected' : '' }}>
                                                                            Bank Transfer
                                                                        </option>
                                                                        <option
                                                                            value="Other"{{ $value->ReciptMode === 'Other' ? ' selected' : '' }}>
                                                                            Other
                                                                        </option>
                                                                    </select>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="number" class="form-control"
                                                                           name="BankAmount[]"
                                                                           value="{{ $value->ReciptMode === 'Cash' ? $value->CashAmount : ( $value->ReciptMode === 'Card' ? $value->CardAmount : ($value->ReciptMode === 'Bank Transfer' ? $value->BankAmount : ($value->ReciptMode === 'Other' ? $value->OtherAmount : '')))}}">
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3 class="card-title text-cyan">Booking Note:</h3>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                                        <textarea class="form-control"
                                                                                  name="BookingNote">{!! isset($customer_details[0]->BookingNotes) ? $customer_details[0]->BookingNotes : '' !!}</textarea>
                                                        </div>
                                                        <div class="col-md-12"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success mt-3">Update Invoice</button>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5 class="text-white mb-0">Upload Recipt</h5>
                        </div>
                        <div class="card-body d-flex align-items-center">
                            <div class="col-lg-7"><img src="{{asset('assets')}}/{{$recipt_details[0]->ReciptImage}}"
                                                       alt="Receipt Image" class="image-fluid" width="400"></div>
                            <div class="col-lg-5">
                                <form method="post" action="{{route('update_recipt_image')}}" accept-charset="utf-8"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="AgentID">
                                    <input type="hidden" name="CustomerID">
                                    <input type="hidden" name="InvoiceNo">
                                    <div class="row">
                                        <div>
                                            <div class="input-group">
                                                <input type="file" name="ReciptImage" class="form-control "
                                                       accept="image/*" value="" required="">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-primary rounded-0">Upload
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        /*<=========================================>
        Code for Payment method selection
        <=========================================>*/
        $(document).ready(function () {
            $('#card-type').on('change', function () {
                var selectedValue = $(this).val();
                if (selectedValue === 'Credit Card' || selectedValue === 'Debit Card') {
                    $('.card-details-section').show();
                } else {
                    $('.card-details-section').hide();
                }
            });
        });
        /*<=========================================>
        Code for Rich text edito
        <=========================================>*/
        tinymce.init({
            selector: 'textarea',
            branding: false,
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save(); // Save the content before form submission
                });
            }
        });

        /*<=========================================>
        Code for Ticket Cost Calculation
        <=========================================>*/
        function calculatePayableTotal() {
            const inputs = document.querySelectorAll('.payable-input');
            let payableTotal = 0;

            inputs.forEach(input => {
                const value = parseFloat(input.value.replace(/,/g, ''));
                if (!isNaN(value)) {
                    payableTotal += value;
                }
            });

            document.getElementById('payableAmount').textContent = payableTotal.toFixed(2);
        }

        function calculateAdditionalTotal() {
            const inputs = document.querySelectorAll('.additional-input');
            let additionalTotal = 0;

            inputs.forEach(input => {
                const value = parseFloat(input.value.replace(/,/g, ''));
                if (!isNaN(value)) {
                    additionalTotal += value;
                }
            });

            document.getElementById('additionalAmount').textContent = additionalTotal.toFixed(2);
        }

        /*<=========================================>
        Code for Recipt detail update
        <=========================================>*/
        var selectElements = document.querySelectorAll('select[name="ReciptMode[]"]');
        selectElements.forEach(function (selectElement) {
            selectElement.addEventListener('change', function () {
                var bankAmountInput = this.parentNode.nextElementSibling.querySelector('.bank-amount-input');

                if (this.value === 'Cash') {
                    bankAmountInput.value = "{{ $value->CashAmount }}";
                } else if (this.value === 'Card') {
                    bankAmountInput.value = "{{ $value->CardAmount }}";
                } else if (this.value === 'Bank Transfer') {
                    bankAmountInput.value = "{{ $value->BankAmount }}";
                } else if (this.value === 'Other') {
                    bankAmountInput.value = "{{ $value->OtherAmount }}";
                } else {
                    bankAmountInput.value = '';
                }
            });
        });
        var searchInput = document.getElementById("DestSearch");
        var citiesList = document.getElementById("DestinationAirport");

        searchInput.addEventListener("keyup", function () {
            var filterText = searchInput.value.toLowerCase();
            var options = citiesList.querySelectorAll("option");

            for (var i = 0; i < options.length; i++) {
                var option = options[i];
                var text = option.textContent.toLowerCase();

                if (text.indexOf(filterText) !== -1) {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }
            }
        });
    </script>
@endsection
