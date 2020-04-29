<?php

function getCorpoAprovacao($nome) {
    return '<!DOCTYPE html PUBLIC>
    <html>
    <head>
        <style type="text/css">
            body {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
                padding-top: 0 !important;
                padding-bottom: 0 !important;
                margin:0 !important;
                width: 100% !important;
                -webkit-text-size-adjust: 100% !important;
                -ms-text-size-adjust: 100% !important;
                -webkit-font-smoothing: antialiased !important;
            }
    
            .tableContent img {
                border: 0 !important;
                display: block !important;
                outline: none !important;
            }
    
            p, h2{
                margin:0;
            }
    
            div,p,ul,h2,h2{
                margin:0;
            }
    
            h2.bigger,h2.bigger{
                font-size: 32px;
                font-weight: normal;
            }
    
            h2.big,h2.big{
                font-size: 21px;
                font-weight: normal;
            }
    
            a.link1{
                color:#62A9D2;font-size:13px;font-weight:bold;text-decoration:none;
            }
    
            a.link2{
                padding:8px;background:#62A9D2;font-size:13px;color:#ffffff;text-decoration:none;font-weight:bold;
            }
    
            a.link3{
                background:#62A9D2; color:#ffffff; padding:8px 10px;text-decoration:none;font-size:13px;
            }
            .bgBody{
                background: #F6F6F6;
            }
            .bgItem{
                background: #ffffff;
            }
    
            @media only screen and (max-width:480px)
    
            {
    
                table[class="MainContainer"], td[class="cell"]
                {
                    width: 100% !important;
                    height:auto !important;
                }
                td[class="specbundle"]
                {
                    width: 100% !important;
                    float:left !important;
                    font-size:13px !important;
                    line-height:17px !important;
                    display:block !important;
    
                }
                td[class="specbundle1"]
                {
                    width: 100% !important;
                    float:left !important;
                    font-size:13px !important;
                    line-height:17px !important;
                    display:block !important;
                    padding-bottom:20px !important;
    
                }
                td[class="specbundle2"]
                {
                    width:90% !important;
                    float:left !important;
                    font-size:14px !important;
                    line-height:18px !important;
                    display:block !important;
                    padding-left:5% !important;
                    padding-right:5% !important;
                }
                td[class="specbundle3"]
                {
                    width:90% !important;
                    float:left !important;
                    font-size:14px !important;
                    line-height:18px !important;
                    display:block !important;
                    padding-left:5% !important;
                    padding-right:5% !important;
                    padding-bottom:20px !important;
                    text-align:center !important;
                }
                td[class="specbundle4"]
                {
                    width: 100% !important;
                    float:left !important;
                    font-size:13px !important;
                    line-height:17px !important;
                    display:block !important;
                    padding-bottom:20px !important;
                    text-align:center !important;
    
                }
    
                td[class="spechide"]
                {
                    display:none !important;
                }
                img[class="banner"]
                {
                    width: 100% !important;
                    height: auto !important;
                }
                td[class="left_pad"]
                {
                    padding-left:15px !important;
                    padding-right:15px !important;
                }
    
            }
    
            @media only screen and (max-width:540px)
    
            {
    
                table[class="MainContainer"], td[class="cell"]
                {
                    width: 100% !important;
                    height:auto !important;
                }
                td[class="specbundle"]
                {
                    width: 100% !important;
                    float:left !important;
                    font-size:13px !important;
                    line-height:17px !important;
                    display:block !important;
    
                }
                td[class="specbundle1"]
                {
                    width: 100% !important;
                    float:left !important;
                    font-size:13px !important;
                    line-height:17px !important;
                    display:block !important;
                    padding-bottom:20px !important;
    
                }
                td[class="specbundle2"]
                {
                    width:90% !important;
                    float:left !important;
                    font-size:14px !important;
                    line-height:18px !important;
                    display:block !important;
                    padding-left:5% !important;
                    padding-right:5% !important;
                }
                td[class="specbundle3"]
                {
                    width:90% !important;
                    float:left !important;
                    font-size:14px !important;
                    line-height:18px !important;
                    display:block !important;
                    padding-left:5% !important;
                    padding-right:5% !important;
                    padding-bottom:20px !important;
                    text-align:center !important;
                }
                td[class="specbundle4"]
                {
                    width: 100% !important;
                    float:left !important;
                    font-size:13px !important;
                    line-height:17px !important;
                    display:block !important;
                    padding-bottom:20px !important;
                    text-align:center !important;
    
                }
    
                td[class="spechide"]
                {
                    display:none !important;
                }
                img[class="banner"]
                {
                    width: 100% !important;
                    height: auto !important;
                }
                td[class="left_pad"]
                {
                    padding-left:15px !important;
                    padding-right:15px !important;
                }
    
                .font{
                    font-size:15px !important;
                    line-height:19px !important;
    
                }
            }
    
    
        </style>
        <script type="colorScheme" class="swatch active">
      {
        "name":"Default",
        "bgBody":"F6F6F6",
        "link":"62A9D2",
        "color":"999999",
        "bgItem":"ffffff",
        "title":"555555"
      }
    </script>
    
    </head>
    <body paddingwidth="0" paddingheight="0"   style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0" style="margin-left:5px; margin-right:5px; margin-top:0px; margin-bottom:0px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent bgBody" align="center"  style="font-family:helvetica, sans-serif;">
    
        <!--  =========================== The header ===========================  -->
    
        <tbody>
        <tr>
            <td height="25" bgcolor="#5e99f7" colspan="3"></td>
        </tr>
        <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td valign="top" class="spechide"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td height="130" bgcolor="#5e99f7">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        </tbody>
                    </table>
                    </td>
                    <td valign="top" width="600"><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="MainContainer" bgcolor="#ffffff">
                        <tbody>
                        <!--  =========================== The body ===========================  -->
                        <tr>
                            <td class="movableContentContainer">
                                <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top">
                                        <tr>
                                            <td bgcolor="#5e99f7" valign="top">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top">
                                                    <tr>
                                                        <td align="center" valign="middle" >
                                                            <div class="contentEditableContainer contentImageEditable">
                                                                <div class="contentEditable" >
                                                                    
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top">
                                        <tr><td height="25" bgcolor="#5e99f7"></td></tr>
    
                                        <tr>
                                            <td>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top" class="bgItem">
                                                    <tr>
                                                        <td  width="70"></td>
                                                        <td  align="center" width="530">
                                                            <div class="contentEditableContainer contentTextEditable">
                                                                <div class="contentEditable" style="font-size:32px;color:#555555;font-weight:normal;">
                                                                    <br>
                                                                    <h2 style="font-size:32px;">Prezado(a) '.$nome.', </h2>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td  width="70"></td>
                                                    </tr>
    
                                                    <tr><td colspan="3" height="22" ></td></tr>
    
                                                    <tr>
                                                        <td width="70"></td>
                                                        <td  align="center" width="530">
                                                            <div class="contentEditableContainer contentTextEditable">
                                                                <div class="contentEditable" style="font-size:13px;color:#555555;font-weight:normal;">
                                                                    <p> Seu cadastro foi aprovado!</p><br>
                                                                    <p>Você já pode acessar o sistema pelo seu navegador.</p><br>
                                                                    <h3>Endereço para acesso: <a href="http://localhost/" >Smart House</a></h3>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td  width="70"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top" class="bgBody" >
                                        <tr><td height="54" style="border-bottom:1px solid #DAE0E4">&nbsp;</td></tr>
    
                                        <tr><td height="28"></td></tr>
    
                                        <tr>
                                            <td valign="top" align="center">
                                                <div class="contentEditableContainer contentTextEditable">
                                                    <div class="contentEditable" style="color:#A8B0B6; font-size:13px;line-height: 16px;">
                                                        <p >Esse e-mail foi enviado através do sistema SmartHouse!
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr><td height="28"></td></tr>
                                    </table>
                                </div>
    
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </td>
                    <td valign="top" class="spechide"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td height="130" bgcolor="#5e99f7">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
                </tbody>
            </table>
            </td>
        </tr>
        </tbody>
    </table>
    
    
    
    </body>
    </html>
    ';
}

?>