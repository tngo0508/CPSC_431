<!DOCTYPE	html>
<?php
        //	create	short	variable	names
        $tireqty	=	$_POST['tireqty'];
        $oilqty	=	$_POST['oilqty'];
        $sparkqty	=	$_POST['sparkqty'];
?>
<html>
		<head>
				<title>Bob's	Auto	Parts	-	Order	Results</title>
		</head>
		<body>
				<h1>Bob's	Auto	Parts</h1>
				<h2>Order	Results</h2>
				<?php
                echo	"<p>Order	processed	at	";
                echo	date('H:i,	jS	F	Y');		echo	"</p>";
                echo	'<p>Your	order	is	as	follows:	</p>';
        echo	htmlspecialchars($tireqty).'	tires<br	/>';
        echo	htmlspecialchars($oilqty).'	bottles	of	oil<br	/>';
        echo	htmlspecialchars($sparkqty).'	spark	plugs<br	/>';

				#same as htmlspecialchars($tireqty).'	tires<br	/>';
                $tireqty	=	htmlspecialchars($tireqty);
        echo	"$tireqty	tires<br	/>";
                ?>
		</body>
</html>
