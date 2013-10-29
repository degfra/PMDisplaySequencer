<?php include '../../includes/helpers.inc.php'; ?> 
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        
    </head>
    <body>
      <?php  foreach ($cliplayouts as $cliplayout): ?>
        <blockquote >
                <?php echo htmlout($cliplayout['cliplayoutname'], ENT_QUOTES, 'UTF-8'); ?>
        </blockquote>
        
        <?php foreach ($layoutsections as $layoutsection): ?>
        
          <?php if ($layoutsection['headersection'] != null) { ?>
            <?php echo htmlout($layoutsection['headersection'], ENT_QUOTES, 'UTF-8') . ' |'; ?> 
          <?php } ?>
          <?php if ($layoutsection['leftbarsection'] != null) { ?>
            <?php echo htmlout($layoutsection['leftbarsection'], ENT_QUOTES, 'UTF-8') . ' |'; ?>
          <?php } ?>
          <?php if ($layoutsection['mainareasection'] != null) { ?>
            <?php echo htmlout($layoutsection['mainareasection'], ENT_QUOTES, 'UTF-8') . ' |'; ?> 
          <?php } ?>
          <?php if ($layoutsection['rightbarsection'] != null) { ?>
            <?php echo htmlout($layoutsection['rightbarsection'], ENT_QUOTES, 'UTF-8') . ' |'; ?>
          <?php } ?>
          <?php if ($layoutsection['footersection'] != null) { ?>
            <?php echo htmlout($layoutsection['footersection'], ENT_QUOTES, 'UTF-8') . ' |'; ?> 
          <?php } ?>
        
            <?php if ($layoutsection['headersection'] != null) { ?>
                <?php foreach ($headerattributes as $headerattribute): ?>
                <blockquote >
                    <?php echo htmlout($headerattribute['headersectiontypeid'], ENT_QUOTES, 'UTF-8'); ?> | 
                    <?php echo htmlout($headerattribute['headersectionname'], ENT_QUOTES, 'UTF-8'); ?> | 
                    <?php echo htmlout($headerattribute['headersectiontypecode'], ENT_QUOTES, 'UTF-8'); ?> | 
                </blockquote>
                <?php endforeach; ?>
            <?php } ?>

            <?php if ($layoutsection['leftbarsection'] != null) { ?>
                <?php foreach ($leftbarattributes as $leftbarattribute): ?>
                <blockquote >
                      <?php echo htmlout($leftbarattribute['leftbarsectiontypeid'], ENT_QUOTES, 'UTF-8'); ?> | 
                      <?php echo htmlout($leftbarattribute['leftbarsectionname'], ENT_QUOTES, 'UTF-8'); ?> | 
                      <?php echo htmlout($leftbarattribute['leftbarsectiontypecode'], ENT_QUOTES, 'UTF-8'); ?> | 
                </blockquote>
                 <?php endforeach; ?>
            <?php } ?>

             <?php if ($layoutsection['mainareasection'] != null) { ?>
                <?php foreach ($mainattributes as $mainattribute): ?>
                <blockquote >
                      <?php echo htmlout($mainattribute['mainsectiontypeid'], ENT_QUOTES, 'UTF-8'); ?> | 
                      <?php echo htmlout($mainattribute['mainsectionname'], ENT_QUOTES, 'UTF-8'); ?> | 
                      <?php echo htmlout($mainattribute['mainsectiontypecode'], ENT_QUOTES, 'UTF-8'); ?> | 
                </blockquote>
                 <?php endforeach; ?>
             <?php } ?>    

            <?php if ($layoutsection['rightbarsection'] != null) { ?>
                <?php foreach ($rightbarattributes as $rightbarattribute): ?>
                <blockquote >
                      <?php echo htmlout($rightbarattribute['rightbarsectiontypeid'], ENT_QUOTES, 'UTF-8'); ?> | 
                      <?php echo htmlout($rightbarattribute['rightbarsectionname'], ENT_QUOTES, 'UTF-8'); ?> | 
                      <?php echo htmlout($rightbarattribute['rightbarsectiontypecode'], ENT_QUOTES, 'UTF-8'); ?> | 
                </blockquote>
                <?php endforeach; ?>
            <?php } ?>

            <?php if ($layoutsection['footersection'] != null) { ?>
                <?php foreach ($footerattributes as $footerattribute): ?>
                <blockquote >
                      <?php echo htmlout($footerattribute['footersectiontypeid'], ENT_QUOTES, 'UTF-8'); ?> | 
                      <?php echo htmlout($footerattribute['footersectionname'], ENT_QUOTES, 'UTF-8'); ?> | 
                      <?php echo htmlout($footerattribute['footersectiontypecode'], ENT_QUOTES, 'UTF-8'); ?> | 
                </blockquote>
                <?php endforeach; ?>
            <?php } ?>
        
        
        
        
          <?php endforeach; ?>
       <?php endforeach; ?> 
    </body>
</html>
