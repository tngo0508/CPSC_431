<!DOCTYPE	html>
<?php
        //	create	short	variable	names
        $tireqty	=	$_POST['tireqty'];
        $oilqty	=	$_POST['oilqty'];
        $sparkqty	=	$_POST['sparkqty'];
        $find = $_POST['find'];
?>
<html>
		<head>
				<title>Bob's	Auto	Parts	-	Order	Results</title>
		</head>
		<body>
				<h1>Bob's	Auto	Parts</h1>
				<h2>Order	Results</h2>
				<?php
        $totalqty	=	0;
        $totalqty	=	$tireqty	+	$oilqty	+	$sparkqty;
                echo	"<p>Order	processed	at	";
                echo	date('H:i,	jS	F	Y');		echo	"</p>";
                echo	'<p>Your	order	is	as	follows:	</p>';
                if ($totalqty	==	0) {
                    echo	'<p	style="color:red">';
                    echo	'You	did	not	order	anything	on	the	previous	page!';
                    echo	'</p>';
                } else {
                    if ($tireqty	>	0) {
                        echo	htmlspecialchars($tireqty).'	tires<br	/>';
                    }
                    if ($oilqty	>	0) {
                        echo	htmlspecialchars($oilqty).'	bottles	of	oil<br	/>';
                    }
                    if ($sparkqty	>	0) {
                        echo	htmlspecialchars($sparkqty).'	spark	plugs<br	/>';
                    }
                }
        #echo	htmlspecialchars($tireqty).'	tires<br	/>';
        #echo	htmlspecialchars($oilqty).'	bottles	of	oil<br	/>';
        #echo	htmlspecialchars($sparkqty).'	spark	plugs<br	/>';
        #same as htmlspecialchars($tireqty).'	tires<br	/>';
                $tireqty	=	htmlspecialchars($tireqty);
        echo	"$tireqty	tires<br	/>";
        echo	<<<theEnd
            line	1
            line	2
            line	3
theEnd;

        echo	"<p>Items	ordered:	".$totalqty."<br	/>";
        $totalamount	=	0.00;
        define('TIREPRICE', 100);
        define('OILPRICE', 10);
        define('SPARKPRICE', 4);
        $totalamount	=	$tireqty	*	TIREPRICE
                          +	$oilqty	*	OILPRICE
                          +	$sparkqty	*	SPARKPRICE;
        echo	"Subtotal:	$".number_format($totalamount, 2)."<br	/>";
        $taxrate	=	0.10;		//	local	sales	tax	is	10%
        $totalamount	=	$totalamount	*	(1	+	$taxrate);
        echo	"Total	including	tax:	$".number_format($totalamount, 2)."</p>";

        echo	'isset($tireqty):	'.isset($tireqty).'<br	/>';
        echo	'isset($nothere):	'.isset($nothere).'<br	/>';
        echo	'empty($tireqty):	'.empty($tireqty).'<br	/>';
        echo	'empty($nothere):	'.empty($nothere).'<br	/>';

        switch ($find) {
        case	"a":
                echo	"<p>Regular	customer.</p>";
                break;
        case	"b":
                echo	"<p>Customer	referred	by	TV	advert.</p>";
                break;
        case	"c":
                echo	"<p>Customer	referred	by	phone	directory.</p>";
                break;
        case	"d":
                echo	"<p>Customer	referred	by	word	of	mouth.</p>";
                break;
        default:
                echo	"<p>We	do	not	know	how	this	customer	found	us.</p>";
                break;
}
        ?>

		</body>
</html>
