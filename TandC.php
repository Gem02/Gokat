<?php

    session_start();
        
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user'];
    }
    if(!isset($user_id)) {
        header('location:login.php');
        exit();
    }

    include "require/header.php";
?>

<body>
    <div class="categorieshead">
            <h5>Terms of Service</h5>
    </div>
    <section class="categories terms">
        <div class="termsarea">
            <h2>Welcome to <strong>GOKA SERVICES</strong></h2>
            <p>
                These terms of service govern your access to and use of Goka Services. 
            </p>
            <p>Please read the Terms of service caefully  before you start to use the site.</p>
            <p>By using the site, opening an account or by clicking to accept the Terms of service
                when this option is made available to you, you accept and agree, on behalf of
                 yourself, or on behalf of your employer or any other entity(if applicable) to be
                 bound and abide by these terms of service by Goka Services.
            </p><br>
            <p>
               The Site is offered to users who are from the age 18 and above any age of less would 
               have to access gokat services through a parent or guidian account
            </p><br>
            <p>
               In opening an account you are obligated to provide us with accurate, complete and updated information 
            </p><br>
            <p>
                You are solely responsible for maintaining and managing your account
                and maintaining the confidentiality of your passwords and security <br><br>
                we are not responsible for any act of omissions by you in connection to your account 
            </p><br>
            <p>
                Only verified registered  users may sell on gokat services 
            </p><br>
            <p> Sellers gain account status base on there confirmed 
               works and performance  accompanied by good reviews
            </p><br>
            <p>
               User may not make payment or accept payment through any method except that provided by gokat services 
            </p><br>
            <p>
                Gokat have the right to use all your published delivered work for gokat marketing and promotions 
            </p><br>
            <p>
                For security reasons Gokat may temporarily disable a sellers ability to
                withdraw revenue to prevent illicit or fraidulence activities this may come though improper  behavior or reports from user 
            </p><br>
            <p>
                The company collect your personal data 
               to use help you connect more to people within your geographical location (contact & location)
               so as with your payment and bank details to enable you view all your transactions and help locate client Incase of any issues 
            </p><br>
            <p>
                The company have the right  to terminate your account after failure to perform 30% of your confirmed work ...<a href="">learn more on this</a>
            </p><br>
            <p>
                Total refund would be made back to client if if you fail to still perform work after 2 days of confirmed date ...<a href="">learn more on this</a>
            </p><br>
            <p>
                 our agents are to interfere in dealings if need be
               The company is not responsible for any deal not confirmed through the platform 
            </p><br>

            

        </div>
        <div class="secondsection">
         <p class="up">Who May Use the Service?</p>

         <div class="breakdown">
            <p>
               This section outlines our relationship with you. It includes a description of the Service, defines our
                Agreement, and names your service provider
            </p><br><br>
            <p>This section sets out certain requirements for use of the Service, and defines categories of users.
            </p><br><br><br>
            <p>
               We maintain strict security systems designed to prevent unauthorised access to your personal information by anyone, including our staff.
            </p><br><br>
            <p>
               Gokat may be required from time to time to disclose your personal information to Governmental or judicial bodies or agencies or our regulators, but we will only do so under proper authority
               <br> Security Assurance.
            </p><br><br>
            <p>
               Gokat and its customers shall play an important role in protecting against online fraud. You should be 
               careful that your bank account details including your User ID and/or Password are not compromised by ensuring that you do not knowingly or accidentally share, provide or facilitate unauthorised use of it. Do not share your User ID and/or password or allow access or use of it by others. 
            </p><br><br>
            <p>
               Use of "cookies”: Your visit to this site may be recorded for analysis on the number of visitors to the site and general
                usage patterns. Some of this information will be gathered through the use of "cookies". Cookies are small bits of information that are automatically stored on a person's web browser in their computer that can be retrieved by this site. Should you wish to disable these cookies you may do so by changing the setting on your browser.
            </p><br><br>
            <p>
               The Site may use cookie and tracking technology depending on the features offered. Cookie and tracking technology are useful for gathering information such as browser type and operating system, tracking the number of visitors to the Site, and understanding how visitors use the Site.
            </p><br><br>
            <p>
               Cookies can also help customize the Site for visitors. Personal information cannot be collected via cookies and other tracking technology; however, if you previously provided personally identifiable information, cookies may be tied to such information. Aggregate cookie and tracking information may be shared with third parties.
            </p><br><br>
            <p>
               this section outline our contract on payment... <a href="">read more on this</a>
            </p>

            <div class="other-links">
               <p class="head">Linked Websites</p>

               <p>
                  Gokat or any other Gokat Group member is not responsible for the contents available on or the set-up of any other websites linked to our site. Access to and use of such other websites is at the user’s own risk and subject to any terms and conditions applicable to such access/use.
                   By providing hyperlinks to other websites, Gokat shall not be deemed to endorse, recommend, approve, guarantee or introduce any third parties or the service/products they provide on their web site, or have any form of cooperation with such third parties and web sites. Gokat is not
                    a party to any contractual arrangements entered into between you and the provider of the external website unless otherwise expressly specified or agreed to by Gokat
               </p><br><br>

               <p>
                  Gokat may contact you regarding your account or the Service. You expressly agree that, as part of the Service, you may, from time to time, receive communications from Gokat via email, instant message, telephone, text message (SMS) or other means. You may stop receiving promotional
                   messages by emailing your request to opt-out, along with your cell phone number  or following the opt-out instructions in the message. Even if you choose to opt out of receiving promotional messages, you may not opt out of receiving service-related messages as these ensure that we
                    are able to deliver accurate, relevant, sensitive and security-related services to you.
               </p>
            </div>
         </div>

        </div>
    </section>