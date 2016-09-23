<html> 
<head>
    <script>
        var a="Hello";
    </script>

</head> 

<body> 
    <?php 
        $variable = "<script>document.write(a)</script>"; //I want above javascript variable 'a' value to be store here
	print $variable;
    ?>
</body> 
