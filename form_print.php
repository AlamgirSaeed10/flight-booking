<?php

require_once("connection.php");
$id = $_REQUEST["id"];
$sql = "SELECT * FROM `cus_details` WHERE `id`='$id' ";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
?>


<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
<style>
*{
    font-family: 'Poppins', sans-serif;

}
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
.img_res{

    width:15vw;
}
th,td{
       margin-bottom: 20px;
    font-style: normal;
    line-height: 1.5;
    font-size:13px;
}
.td-right{
    text-align:right;
     font-size:13px;
}
.td-left{
    text-align:left;
     font-size:13px;
}
.address-div{
    margin-bottom:10px;
}
.terms{
    font-weight:bold;
}
    </style>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title row">
    			<h2>Invoice</h2>
    			<h3 class="pull-right">
    			    <img src="zis_travels.png" class="img_res">
    			    </h3>
    		</div>
    		<div class="row address-div">
    			<div class="col-xs-6  text-left">
    			    <strong>To,</strong>
    			<table style="width:100%">
                          <tr>
                            <td class="td-left"><?php echo $row['name1'] ?></td>
                            </tr>
                            <tr>
                            <td class="td-left">
                                <?php
                                $words = explode(" ", $row['address']);
                                $chunks = array_chunk($words, 6);
                                $newString = implode(",<br>", array_map(function($chunk) {
                                    return implode(" ", $chunk);
                                }, $chunks));
                                echo $newString;
                                ?>
                                </td>
                            </tr>
                            <tr>
                            <td class="td-left"><?php echo $row['cus_phone'] ?></td>
                          </tr>
                            <tr>
                            <td class="td-left"><?php echo $row['email'] ?></td>
                          </tr>
                        </table>
    			</div>
    			<div class="col-xs-6 text-right mb-3">
    			    <strong>&nbsp;</strong>
    					<table style="width:100%">
                          <tr>
                            <th>Invoice #:</th>
                            <td class="td-right"><?php echo $row['invoice'] ?></td>
                          </tr>
                          <tr>
                            <th>Invoice Date:</th>
                            <td class="td-right"><?php echo date('d-m-Y',strtotime($row['invoice_d'])) ?></td>
                          </tr>
                          <tr>
                            <th>AirLine Confirmation #</th>
                            <td class="td-right"><?php echo $row['airline_con'] ?></td>
                          </tr>
                          <tr>
                            <th>Agent Name</th>
                            <td class="td-right"><?php echo $row['ag_name'] ?></td>
                          </tr>
                        </table>

    			</div>
    		</div>
    		<hr>
    		 <div class="row">
        <div class="col-xs-12">
    			    <strong>Flight Details</strong>
    		<div class="row address-div">
    			<div class="col-xs-7  text-left">

    				<table style="width:100%">
                          <tr>
                            <th>Departure Airport:</th>
                            <td class="td-left"><?php echo $row['dep_airport'] ?></td>
                          </tr>
                          <tr>
                            <th>Departure Date:</th>
                            <td class="td-left"><?php echo date('d-m-Y',strtotime($row['dep_date'])) ?></td>
                          </tr>
                          <tr>
                            <th>Cabin Class:</th>
                            <td class="td-left"><?php echo $row['cab_class'] ?></td>
                          </tr>
                        </table>
    			</div>
    			<div class="col-xs-5 text-right mb-3">

    					<table style="width:100%">
                          <tr>
                            <th>Destination Airport:</th>
                            <td class="td-right"><?php echo $row['des_airport'] ?></td>
                          </tr>
                          <tr>
                            <th>Return Date:</th>
                            <td class="td-right"><?php echo date('d-m-Y',strtotime($row['ret_date'])) ?></td>
                          </tr>
                          <tr>
                            <th>Type: </th>
                            <td class="td-right"><?php echo $row['f_type'] ?></td>
                          </tr>
                        </table>

    			</div>
    		</div>
    	</div>
    	 <div class="col-xs-12">
    	     <strong>Details</strong>
            <p><?php echo $row['description'] ?></p>
    	     </div>
            </div>
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h5 class="panel-title"><strong>Passenger Details</strong></h5>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>SR #</strong></td>
        							<td class="text-center"><strong>Passenger Name</strong></td>
        							<td class="text-center"><strong>Total</strong></td>
                                </tr>
    						</thead>
    						<tbody>

    						    <?php
    						    $total_amount= 0;
    						    $total_booking_fee= 0;
    						    $select_querys = "SELECT * FROM `cus_detail` WHERE `cus_detail_id`= ". $row['id'];
    						    $result = mysqli_query($conn, $select_querys);
    						    if (mysqli_num_rows($result) > 0) {
    						        while ($rows = mysqli_fetch_array($result)) {
    						            $total_amount += $rows['amount'];
    						            $total_booking_fee += $rows['booking_fee'];
    						        ?>
    							<tr>
    								 <td><?php echo ++$i; ?></td>
    								<td class="text-center"><?php echo $rows['name'] ?></td>
    								<td class="text-right">
    								<?php if($rows['amount'] <9)
    								{
    								echo "0".$rows['amount'] . " £ " ;
    								}else{
    								echo $rows['amount'] ." £ ";
    								}
    								?>
    								</td>
    							</tr>
    							<?php
    						        }
    						        }
    						        ?>
    						</tbody>
    						<tfoot>
    						    	<tr>
    								<td class="text-left"><strong>Total Price</strong></td>
    								<td colspan="2" class="text-right"><b> <?php echo $total_amount;?> £ </b></td>
    							</tr>
    							<tr>
    								<td class="text-left"><strong>Total Booking Fee</strong></td>
    								<td colspan="2" class="text-right"><b> <?php echo $total_booking_fee;?> £ </b></td>
    							</tr>
    							<tr>
    								<td class="text-left"><strong>Grand Total</strong></td>
    								<td colspan="2" class="text-right"><b> <?php echo $total_booking_fee + $total_amount;?> £ </b></td>
    							</tr>
    						</tfoot>
    					</table>
    				</div>

    			</div>

    		</div>
    	</div>



    </div>

    	<div class="text-right" style="margin-top:10px;">
    	    <p >___________________________</p><br>
            <p>Customer Name and Signature</p>

    	</div>


    <p style="page-break-after: always;">&nbsp;<br></p>

    <br><br>

    <h4 class="text-center terms">Booking Terms & Conditions</h4>
	<p>Please read these carefully as the person making this booking (either for him selves or for any other passenger) accepts all the below terms and
	conditions of Zistravels.</p>
	<h5 class="text-center terms">DEPOSITS FOR HOLIDAY ARE NEITHER REFUNDABLE NOR CHANGEABLE (Terms & Conditions May Apply).</h5>
	<p>Unless Specified, All the deposits paid for flights and accommodation purchased/issued is non-refundable. In case of cancellation or no show (Failure to arrive
	or check-in on time) and non-changeable before or after departure (date change is not permitted). Once holiday is reserved, bookings/tickets are non-transferable to any other person means that name changes are not permitted.</p>
	<p>If you are reserving the flight or accommodation or both by making the advance partial payment (Initial deposit) then please note that fare/taxes may
	increase at any time without the prior notice. It means the price is not guaranteed unless the ticket is issued because the airline/consolidator has the right to
	increase the price due to any reason. In that case, we will not be liable and the passenger has to pay the fare/tax difference. We always recommend you to
	pay ASAP and get issue your flight tickets or holiday to avoid this situation. Furthermore, if you will cancel your reservation due to any reason, then the paid
	deposit(s) will be non-refundable.</p>
	<h5 class="terms">CHECKING ALL FLIGHT DETIALS & PASSENGER NAME(S)</h5>
	<p>It is your responsibility to check all the details are correct i.e. Passenger names (are same as appearing on passport/travel docs), Travelling dates, Transit Time,
	Origin & Destination, Stop Over, Baggage Allowance, and other flight information. Once the ticket is issued then no changes can be made, unless specified.</p>
	<h5 class="terms">PASSPORT, VISA &amp; IMMIGRATION REQUIREMENTS</h5>
    <p>You are responsible for checking all these items like Passport, Visa (including Transit Visa), and other immigration requirements. You must consult with the relevant Embassy/Consulate, well before the departure time for up-to-date information as requirements may change from time to time. We regret we cannot accept the liability of any transit visa and if you are refused to board the flight or could not clear the immigration or any kind of failure in providing the information required like passport, visa or other documents required by any airline, authority or country. We also recommend you that to check this link <a href="https://www.gov.uk/foreign-travel-advice">https://www.gov.uk/foreign-travel-advice</a> for travel advice.</p>

    <h5 class="terms">RECONFIRMING RETURN/ONWARD FLIGHTS</h5>
    <p>It is the traveler's responsibility to RECONFIRM your flights at least 72 hours before your departure time either with your travel agent or the relevant Airline directly. The company will not be liable for any additional costs due to your failure to reconfirm your flights.</p>
    <h5 class="terms">SPECIAL REQUESTS AND MEDICAL PROBLEMS</h5>
    <p>If you have any special requests like meal preference, Seat Allocation and wheelchair request, etc, please advise us at the time of issuance of the ticket. We will try our best to fulfill these bypassing this request to the relevant airlines, but we cannot guarantee and failure to meet any special request will not hold us liable for any claim.</p>

    <h5 class="terms">Covid-19</h5>
    <p>Due to Covid-19, Additional entry requirements have been introduced which varies from country to country and may be subject to change with short notice. You are responsible for checking and conforming with the entry and exit requirements at their origins and destinations. Requirements may include proof of negative PCR Covid-19 tests, temperature checks or completion of forms, etc.</p>
    <p>If the flight is affected due to Covid-19 then airline policies will be applied. To accommodate the traveler, it is quite possible that the airline only offers the future date change or credit voucher option instead of a refund. In that case, you must have to follow the airline rules and cannot demand a refund. If a full refund is permitted, A admin fee (Per person) will be deducted as the service charges and a refund can take up to 3 months. If the flight is operated by the airline and you decide not to board the flight, then you will be ineligible for a refund. In this case (if your ticket is refundable) then airline fare rules (cancellation fee) will be applied for processing the refunds.</p>

    <h5 class="terms">VERY IMPORTANT:</h5>
<p>Zistravels does not accept responsibility for any kind of loss if the airline fails to operate due to any unforeseen circumstances like weather, war, natural disaster, pandemic, riots, strikes, etc. Passengers will be solely responsible for that so it is highly recommended that separate travel and health insurance must be arranged to protect you.</p>
    <p>We advise you to read our complete terms and conditions mentioned at <a href="http://www.zistravels.co.uk/terms.php"> http://www.zistravels.co.uk/terms-and-conditions</a> on our website.</p>

    </div>
    </div>


























