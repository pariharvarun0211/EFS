@extends('app')
@section('content')
    <h1>Customer Portfolio</h1>
	<div class="container">	
	<h2>Customer</h2>
        <table class="table table-striped table-bordered table-hover">
			<tbody>
            <tr class="bg-info">
            <tr>
                <td>Name</td>
                <td><?php echo ($customer['name']); ?></td>
            </tr>
            <tr>
                <td>Cust Number</td>
                <td><?php echo ($customer['cust_number']); ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo ($customer['address']); ?></td>
            </tr>
            <tr>
                <td>City </td>
                <td><?php echo ($customer['city']); ?></td>
            </tr>
            <tr>
                <td>State</td>
                <td><?php echo ($customer['state']); ?></td>
            </tr>
            <tr>
                <td>Zip </td>
                <td><?php echo ($customer['zip']); ?></td>
            </tr>
            <tr>
                <td>Home Phone</td>
                <td><?php echo ($customer['home_phone']); ?></td>
            </tr>
            <tr>
                <td>Cell Phone</td>
                <td><?php echo ($customer['cell_phone']); ?></td>
            </tr>
			<tr>
                <td>Email</td>
                <td><?php echo ($customer['email']); ?></td>
            </tr>
            </tbody>  
			</tbody>
        </table>
    </div>
	<?php
    $stocks_total_i = 0;
	$stocks_total_c = 0;
	$svalue = 0;
    ?>
	<div class="container">	
	<br>
	<h2>Stocks</h2>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr class="bg-info">
                <th>Symbol</th>
                <th>Stock Name</th>
                <th>No. of Shares</th>
                <th>Purchase Price ($)</th>
                <th>Purchase Date</th>
				<th>Original Value ($)</th>
				<th>Current Price ($)</th>
				<th>Current Value ($)</th>
               </tr>
            </thead>
            <tbody>
                @foreach($customer->stocks as $stock)
                    <tr>
                        <td>{{ $stock->symbol }}</td>
                        <td>{{ $stock->name }}</td>
                        <td>{{ $stock->shares }}</td>
                        <td>{{ $stock->purchase_price }}</td>
                        <td>{{ $stock->purchased }}</td>
                        <td> <?php echo $stock['shares']*$stock['purchase_price'];
                            $stocks_total_i = $stocks_total_i + $stock['shares'] * $stock['purchase_price']?>
                        </td>
						<?php
                        $URL="https://finance.google.com/finance/info?client=ig&q=" . $stock->symbol;
                        $file = fopen("$URL", "r");
                        $r = "";
                        do {
                        $data = fread($file, 500);
                        $r .= $data;
                        } while (strlen($data) != 0);

                        $json = str_replace("\n", "", $r);
                        $data = substr($json, 4, strlen($json) - 5);
                        $json_output = json_decode($data, true);
                        $stock_curr_value = "\n" . $json_output['l'];
                        ?>
                        <td><?php echo '$', $stock_curr_value ?></td>
                        <td> <?php echo $stock['shares']*$stock_curr_value;
                            $stocks_total_c = $stocks_total_c + $stock['shares'] * $stock_curr_value?>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
		<h4> Total value of Stocks (Initial) = <?php echo '$'."$stocks_total_i" ?></h4>
		<h4> Total value of Stocks (Current) = <?php echo '$'."$stocks_total_c" ?></h4>
    </div>
<br>
<?php
    $sum_investment_initial = 0;
    ?>
	<?php
    $sum_investment_current = 0;
    ?>
	<div class="container">	
	<h2>Investments </h2>
            <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr class="bg-info">
                <th>Category </th>
                <th>Description</th>
                <th>Acquired Value ($)</th>
                <th>Acquired Date</th>
                <th>Recent Value ($)</th>
				<th>Recent Date</th>
               </tr>
            </thead>
            <tbody>
                @foreach($customer->investments as $investment)
                    <tr>
                        <td>{{ $investment->category }}</td>
                        <td>{{ $investment->description }}</td>
                        <td>{{ $investment->acquired_value }}
						<?php $sum_investment_initial = $sum_investment_initial + $investment['acquired_value'] ?>
						</td>
                        <td>{{ $investment->acquired_date }}</td>
                        <td>{{ $investment->recent_value }}
						<?php
                        $sum_investment_current = $sum_investment_current + $investment['recent_value']
                        ?>
						</td>		
                        <td>{{ $investment->recent_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
		<h4> Total Acquired Value Of Investments = <?php echo '$'."$sum_investment_initial" ?></h4>
		<h4> Total Current Value Of Investments = <?php echo '$'."$sum_investment_current" ?></h4>
		<?php
		$assets = 0;
		?>
		<div class="container">	
		<h2>Summary of Portfolio</h2>
		<?php $init_port_value = $sum_investment_initial + $stocks_total_i ?>
		<h4> Total of Initial Portfolio Value = <?php echo '$'."$init_port_value" ?></h4>
		<?php $current_port_value = $sum_investment_current + $stocks_total_c ?>
		<h4> Total of Current Portfolio Value = <?php echo '$'."$current_port_value" ?></h4>
		</div>
    </div>	
	@stop