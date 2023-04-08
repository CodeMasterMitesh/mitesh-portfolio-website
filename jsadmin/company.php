<?php
if (isset($_POST['save'])) {
    foreach($_POST as $a=>$b)
    {
        if($a!='save'){
        $sql="replace into settings (`name`,`value`) values('".$a."','".$b."')";        
        $q = mysql_query($sql) or die(mysql_error().$sql);
        }
    }
    if ($q)
        echo "<script>alert('Setting saved');window.location='index.php?p=company';</script>";
}

function  getdata($name)
{
    $sql1="select * from settings where name like '".$name."'";
    $q1= mysql_query($sql1) or die(mysql_error().$sql1);    
    $r=  mysql_fetch_assoc($q1);
     return $r['value'];     
}
$pdata=array();
$sql1="select * from settings where name like 'company_%'";
 $q1= mysql_query($sql1) or die(mysql_error().$sql1);    
    while($r=  mysql_fetch_assoc($q1) ){
        $pdata[$r['name']]=   $r['value'];
    }
?>

<div class="page-header" > 
            <div class="page-title"> <h3>Setting:Company</h3> </div> 
            <a href="index.php?p=company">

            </a>
        </div> 

 <form class="form-horizontal row-border" id="companysetting" method="post"  action="" enctype="multipart/form-data">
<div class="panel panel-default" style="vertical-align: top; ">
        <div class="panel-heading " style="vertical-align: top;">
            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="">Setting : Company</a> </h3>
        </div>
        <!--                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">-->
        <div class="panel-body" style="vertical-align: top;"> 


            <div class="" style="border:none; vertical-align: top;">
                <!--                                    <div class="widget-content">-->

                <style>
                    .company_table td:nth-child(3){
                        padding-left: 16px;
                    }
                </style>
                <table style="width: 100%; vertical-align: top; line-height: 50px;" class="company_table ">
                   
                    <tr>
                        <td>
                        Company name:
                        </td>
                        <td>
                            <input type="text" name="company_name"  class="form-control required has-error discount" style="border-radius: 6px; " value="<?php echo getdata('company_name');?>"> 
                        </td>
                        <td>
                            Company address:
                        </td>
                        <td>
                            <input type="text" name="company_addr"  class="form-control required has-error discount" style="border-radius: 6px; ">   
                        </td>
                    </tr>
                    
                     <tr>
                        <td>
                       Company city:
                        </td>
                        <td>
                          <input type="text" name="company_city"  class="form-control required has-error discount" style="border-radius: 6px; "> 
                        </td>
                        <td>
                           Company country:
                        </td>
                        <td>
                            <select name="company_country"  class="form-control required has-error discount" style="border-radius: 6px; ">
                           
                                <option value="" selected="">- Select country -</option>
                                                               
                                <option value="AF">Afghanistan</option>
                                            <option value="AX">Aland Islands</option>
                                            <option value="AL">Albania</option>
                                            <option value="DZ">Algeria</option>
                                            <option value="AS">American Samoa</option>
                                            <option value="AD">Andorra</option>
                                            <option value="AO">Angola</option>
                                            <option value="AI">Anguilla</option>
                                            <option value="AQ">Antarctica</option>
                                            <option value="AG">Antigua and Barbuda</option>
                                            <option value="AR">Argentina</option>
                                            <option value="AM">Armenia</option>
                                            <option value="AW">Aruba</option>
                                            <option value="AP">Asia-Pacific</option>
                                            <option value="AU">Australia</option>
                                            <option value="AT">Austria</option>
                                            <option value="AZ">Azerbaijan</option>
                                            <option value="BS">Bahamas</option>
                                            <option value="BH">Bahrain</option>
                                            <option value="BD">Bangladesh</option>
                                            <option value="BB">Barbados</option>
                                            <option value="BY">Belarus</option>
                                            <option value="BE">Belgium</option>
                                            <option value="BZ">Belize</option>
                                            <option value="BJ">Benin</option>
                                            <option value="BM">Bermuda</option>
                                            <option value="BT">Bhutan</option>
                                            <option value="BO">Bolivia</option>
                                            <option value="BA">Bosnia and Herzegowina</option>
                                            <option value="BW">Botswana</option>
                                            <option value="BV">Bouvet Island</option>
                                            <option value="BR">Brazil</option>
                                            <option value="IO">British Indian Ocean Territory</option>
                                            <option value="VG">British Virgin Islands</option>
                                            <option value="BN">Brunei Darussalam</option>
                                            <option value="BG">Bulgaria</option>
                                            <option value="BF">Burkina Faso</option>
                                            <option value="BI">Burundi</option>
                                            <option value="KH">Cambodia</option>
                                            <option value="CM">Cameroon</option>
                                            <option value="CA">Canada</option>
                                            <option value="CV">Cape Verde</option>
                                            <option value="KY">Cayman Islands</option>
                                            <option value="CF">Central African Republic</option>
                                            <option value="TD">Chad</option>
                                            <option value="CL">Chile</option>
                                            <option value="CN">China</option>
                                            <option value="CX">Christmas Island</option>
                                            <option value="CC">Cocos (Keeling) Islands</option>
                                            <option value="CO">Colombia</option>
                                            <option value="KM">Comoros</option>
                                            <option value="CG">Congo</option>
                                            <option value="CK">Cook Islands</option>
                                            <option value="CR">Costa Rica</option>
                                            <option value="CI">Cote D'ivoire</option>
                                            <option value="HR">Croatia</option>
                                            <option value="CU">Cuba</option>
                                            <option value="CW">Curaçao</option>
                                            <option value="CY">Cyprus</option>
                                            <option value="CZ">Czech Republic</option>
                                            <option value="DK">Denmark</option>
                                            <option value="DJ">Djibouti</option>
                                            <option value="DM">Dominica</option>
                                            <option value="DO">Dominican Republic</option>
                                            <option value="TL">East Timor</option>
                                            <option value="EC">Ecuador</option>
                                            <option value="EG">Egypt</option>
                                            <option value="SV">El Salvador</option>
                                            <option value="GQ">Equatorial Guinea</option>
                                            <option value="ER">Eritrea</option>
                                            <option value="EE">Estonia</option>
                                            <option value="ET">Ethiopia</option>
                                            <option value="EU">Europe</option>
                                            <option value="FK">Falkland Islands (Malvinas)</option>
                                            <option value="FO">Faroe Islands</option>
                                            <option value="FJ">Fiji</option>
                                            <option value="FI">Finland</option>
                                            <option value="FR">France</option>
                                            <option value="FX">France, Metropolitan</option>
                                            <option value="GF">French Guiana</option>
                                            <option value="PF">French Polynesia</option>
                                            <option value="TF">French Southern Territories</option>
                                            <option value="GA">Gabon</option>
                                            <option value="GM">Gambia</option>
                                            <option value="GE">Georgia</option>
                                            <option value="DE">Germany</option>
                                            <option value="GH">Ghana</option>
                                            <option value="GI">Gibraltar</option>
                                            <option value="GR">Greece</option>
                                            <option value="GL">Greenland</option>
                                            <option value="GD">Grenada</option>
                                            <option value="GP">Guadeloupe</option>
                                            <option value="GU">Guam</option>
                                            <option value="GT">Guatemala</option>
                                            <option value="GG">Guernsey</option>
                                            <option value="GN">Guinea</option>
                                            <option value="GW">Guinea-Bissau</option>
                                            <option value="GY">Guyana</option>
                                            <option value="HT">Haiti</option>
                                            <option value="HM">Heard and McDonald Islands</option>
                                            <option value="HN">Honduras</option>
                                            <option value="HK">Hong Kong</option>
                                            <option value="HU">Hungary</option>
                                            <option value="IS">Iceland</option>
                                            <option value="IN">India</option>
                                            <option value="ID">Indonesia</option>
                                            <option value="IQ">Iraq</option>
                                            <option value="IE">Ireland</option>
                                            <option value="IR">Islamic Republic of Iran</option>
                                            <option value="IM">Isle of Man</option>
                                            <option value="IL">Israel</option>
                                            <option value="IT">Italy</option>
                                            <option value="JM">Jamaica</option>
                                            <option value="JP">Japan</option>
                                            <option value="JE">Jersey</option>
                                            <option value="JO">Jordan</option>
                                            <option value="KZ">Kazakhstan</option>
                                            <option value="KE">Kenya</option>
                                            <option value="KI">Kiribati</option>
                                            <option value="KP">Korea</option>
                                            <option value="KR">Korea, Republic of</option>
                                            <option value="KW">Kuwait</option>
                                            <option value="KG">Kyrgyzstan</option>
                                            <option value="LA">Laos</option>
                                            <option value="LV">Latvia</option>
                                            <option value="LB">Lebanon</option>
                                            <option value="LS">Lesotho</option>
                                            <option value="LR">Liberia</option>
                                            <option value="LY">Libyan Arab Jamahiriya</option>
                                            <option value="LI">Liechtenstein</option>
                                            <option value="LT">Lithuania</option>
                                            <option value="LU">Luxembourg</option>
                                            <option value="MO">Macau</option>
                                            <option value="MK">Macedonia</option>
                                            <option value="MG">Madagascar</option>
                                            <option value="MW">Malawi</option>
                                            <option value="MY">Malaysia</option>
                                            <option value="MV">Maldives</option>
                                            <option value="ML">Mali</option>
                                            <option value="MT">Malta</option>
                                            <option value="MH">Marshall Islands</option>
                                            <option value="MQ">Martinique</option>
                                            <option value="MR">Mauritania</option>
                                            <option value="MU">Mauritius</option>
                                            <option value="YT">Mayotte</option>
                                            <option value="MX">Mexico</option>
                                            <option value="FM">Micronesia</option>
                                            <option value="MD">Moldova, Republic of</option>
                                            <option value="MC">Monaco</option>
                                            <option value="MN">Mongolia</option>
                                            <option value="ME">Montenegro</option>
                                            <option value="MS">Montserrat</option>
                                            <option value="MA">Morocco</option>
                                            <option value="MZ">Mozambique</option>
                                            <option value="MM">Myanmar</option>
                                            <option value="NA">Namibia</option>
                                            <option value="NR">Nauru</option>
                                            <option value="NP">Nepal</option>
                                            <option value="NL">Netherlands</option>
                                            <option value="NC">New Caledonia</option>
                                            <option value="NZ">New Zealand</option>
                                            <option value="NI">Nicaragua</option>
                                            <option value="NE">Niger</option>
                                            <option value="NG">Nigeria</option>
                                            <option value="NU">Niue</option>
                                            <option value="NF">Norfolk Island</option>
                                            <option value="MP">Northern Mariana Islands</option>
                                            <option value="NO">Norway</option>
                                            <option value="OM">Oman</option>
                                            <option value="PK">Pakistan</option>
                                            <option value="PW">Palau</option>
                                            <option value="PS">Palestine Authority</option>
                                            <option value="PA">Panama</option>
                                            <option value="PG">Papua New Guinea</option>
                                            <option value="PY">Paraguay</option>
                                            <option value="PE">Peru</option>
                                            <option value="PH">Philippines</option>
                                            <option value="PN">Pitcairn</option>
                                            <option value="PL">Poland</option>
                                            <option value="PT">Portugal</option>
                                            <option value="PR">Puerto Rico</option>
                                            <option value="QA">Qatar</option>
                                            <option value="RS">Republic of Serbia</option>
                                            <option value="RE">Reunion</option>
                                            <option value="RO">Romania</option>
                                            <option value="RU">Russian Federation</option>
                                            <option value="RW">Rwanda</option>
                                            <option value="LC">Saint Lucia</option>
                                            <option value="WS">Samoa</option>
                                            <option value="SM">San Marino</option>
                                            <option value="ST">Sao Tome and Principe</option>
                                            <option value="SA">Saudi Arabia</option>
                                            <option value="SN">Senegal</option>
                                            <option value="CS">Serbia</option>
                                            <option value="SC">Seychelles</option>
                                            <option value="SL">Sierra Leone</option>
                                            <option value="SG">Singapore</option>
                                            <option value="SX">Sint Maarten</option>
                                            <option value="SK">Slovakia</option>
                                            <option value="SI">Slovenia</option>
                                            <option value="SB">Solomon Islands</option>
                                            <option value="SO">Somalia</option>
                                            <option value="ZA">South Africa</option>
                                            <option value="ES">Spain</option>
                                            <option value="LK">Sri Lanka</option>
                                            <option value="SH">St. Helena</option>
                                            <option value="KN">St. Kitts and Nevis</option>
                                            <option value="PM">St. Pierre and Miquelon</option>
                                            <option value="VC">St. Vincent and the Grenadines</option>
                                            <option value="SD">Sudan</option>
                                            <option value="SR">Suriname</option>
                                            <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                            <option value="SZ">Swaziland</option>
                                            <option value="SE">Sweden</option>
                                            <option value="CH">Switzerland</option>
                                            <option value="SY">Syrian Arab Republic</option>
                                            <option value="TW">Taiwan</option>
                                            <option value="TJ">Tajikistan</option>
                                            <option value="TZ">Tanzania, United Republic of</option>
                                            <option value="TH">Thailand</option>
                                            <option value="TG">Togo</option>
                                            <option value="TK">Tokelau</option>
                                            <option value="TO">Tonga</option>
                                            <option value="TT">Trinidad and Tobago</option>
                                            <option value="TN">Tunisia</option>
                                            <option value="TR">Turkey</option>
                                            <option value="TM">Turkmenistan</option>
                                            <option value="TC">Turks and Caicos Islands</option>
                                            <option value="TV">Tuvalu</option>
                                            <option value="UG">Uganda</option>
                                            <option value="UA">Ukraine</option>
                                            <option value="AE">United Arab Emirates</option>
                                            <option value="GB">United Kingdom (Great Britain)</option>
                                            <option value="US" selected="selected">United States</option>
                                            <option value="VI">United States Virgin Islands</option>
                                            <option value="UY">Uruguay</option>
                                            <option value="UZ">Uzbekistan</option>
                                            <option value="VU">Vanuatu</option>
                                            <option value="VA">Vatican City State</option>
                                            <option value="VE">Venezuela</option>
                                            <option value="VN">Viet Nam</option>
                                            <option value="WF">Wallis And Futuna Islands</option>
                                            <option value="EH">Western Sahara</option>
                                            <option value="YE">Yemen</option>
                                            <option value="ZR">Zaire</option>
                                            <option value="ZM">Zambia</option>
                                            <option value="ZW">Zimbabwe</option>
                                    
                            
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                      Company state:
                        </td>
                        <td>
                             <select name="company_state"  class="form-control required has-error discount" style="border-radius: 6px; ">
                                
                    <option value="">- Select state -</option>
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="DC">District of Columbia</option>
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="GU">Guam</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA" selected="">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="MP">Northern Mariana Islands</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="PR">Puerto Rico</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VI">Virgin Islands</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
                                 
                                 
                                 
                                 
                             </select>
                         
                        </td>
                        <td>
                          Company zip code:
                        </td>
                        <td>
                           <input type="text" name="company_zcode"  class="form-control required has-error discount" style="border-radius: 6px; ">  
                        </td>
                    </tr>
                    
                     <tr>
                        <td>
                     Company phone:
                        </td>
                        <td>
                            <input type="text" name="company_phone"  class="form-control required has-error discount" style="border-radius: 6px; ">
                         
                        </td>
                        <td>
                          Company phone 2:
                        </td>
                        <td>
                           <input type="text" name="company_phone2"  class="form-control required has-error discount" style="border-radius: 6px; ">  
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                    Company fax:
                        </td>
                        <td>
                            <input type="text" name="company_fax"  class="form-control required has-error discount" style="border-radius: 6px; ">
                         
                        </td>
                        <td>
                         Website:
                        </td>
                        <td>
                           <input type="text" name="company_website"  class="form-control required has-error discount" style="border-radius: 6px; ">  
                        </td>
                    </tr>
                    
                     
                    
                     <tr>
                        <td>
                  Administrator e-mail address:
                        </td>
                        <td>
                            <input type="text" name="company_adminemailaddr"  class="form-control required has-error discount" style="border-radius: 6px; ">
                         
                        </td>
                        <td>
                      Order  e-mail address:
                        </td>
                        <td>
                           <input type="text" name="company_orderemailaddr"  class="form-control required has-error discount" style="border-radius: 6px; ">  
                        </td>
                    </tr>
                    
                     <tr>
                        <td>
                 Support  e-mail address:
                        </td>
                        <td>
                            <input type="text" name="company_supportemailaddr"  class="form-control required has-error discount" style="border-radius: 6px; ">
                         
                        </td>
                        <td>
                   Newsletter e-mail address:
                        </td>
                        <td>
                           <input type="text" name="company_newsletteremailaddr"  class="form-control required has-error discount" style="border-radius: 6px; ">  
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                 Customer  e-mail address:
                        </td>
                        <td>
                            <input type="text" name="company_custemailaddr"  class="form-control required has-error discount" style="border-radius: 6px; ">
                         
                        </td>
                        <td>
                      
                        </td>
                        <td>
                         
                        </td>
                    </tr>
                </table>

                    

            </div>
        </div>
    </div>


<div class="btn-bar btn-toolbar dropleft pull-right" style="margin-right: 10px;">

    <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="save" value="Save"/>

</div>
<script type="text/javascript">
                                                datas = Array();
<?php
foreach ($pdata as $a => $b) {
   
    if (strpos($a, "date") || $a == "date" || strpos($a, "datetime") || $a == 'datetime')
        echo 'datas["' . $a . '"]="' . mysql2dmy($b) . '";';
    elseif ($a != 'description')
        echo 'datas["' . $a . '"]="' . mysql_escape_string($b) . '";';
}
?>
                                                $(document).ready(function() {
                                                    $('#companysetting input[type="text"]').each(function() {
                                                        if (typeof datas[$(this).attr('name')] != 'undefined') {
                                                            $(this).val(datas[$(this).attr('name')]);
                                                        }
                                                    });
                                                    $('#companysetting input[type="hidden"]').each(function() {
                                                        if (typeof datas[$(this).attr('name')] != 'undefined') {
                                                            $(this).val(datas[$(this).attr('name')]);
                                                        }
                                                    });
                                                    $('#companysetting textarea').each(function() {
                                                        if (typeof $(this).attr('name') != 'undefined')
                                                            $(this).html(datas[$(this).attr('name')]);
                                                    });
                                                    $('#companysetting input[type="checkbox"]').each(function() {
                                                        if ($(this).val() == datas[$(this).attr('name')]) {
                                                            $(this).attr('checked', 'checked')
                                                        }
                                                    });
                                                    $('#companysetting input[type="radio"]').each(function() {
                                                        if ($(this).val() == datas[$(this).attr('name')]) {
                                                            $(this).attr('checked', 'checked')
                                                        }
                                                    });
                                                    $('#companysetting select').each(function() {
                                                        $(this).find('option[value="' + $.trim(datas[$(this).attr('name')]) + '"]').attr('selected', 'selected');
                                                    });
                                                });
</script>
 </form>
