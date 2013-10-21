<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php foreach ($clips as $previewedclip): ?>
        <table width='100%' border='0' cellspacing='0'>
            <tr  align='center'>
                <td colspan="3"><?php echo $previewedclip['headercode']; ?></td> 
            </tr>
            <tr  align='center'>
                <td width='20%'><?php echo $previewedclip['leftbarcode']; ?></td> 
                <td width='60%'><?php echo $previewedclip['mainareacode']; ?></td> 
                <td width='20%'><?php echo $previewedclip['rightbarcode']; ?></td> 
            </tr>
            <tr  align='center'>
                <td colspan="3"><?php echo $previewedclip['footercode']; ?></td> 
            </tr>
        </table>
        <?php endforeach; ?>
    </body>
</html>
