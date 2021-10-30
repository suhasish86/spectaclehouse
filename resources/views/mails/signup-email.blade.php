<body style="background-color: #f6f6f6;">
    <table align="center" style="font-family: Arial, Helvetica, sans-serif; font-size: 17px; color: #000000; max-width: 600px; margin: 0 auto;">
         <tr>
           <td>
            <table width="100%">
              <!-- Header -->
              <tr>
                <td style="background-color: #ec9f02; padding: 10px 35px; border-radius: 4px 4px 0 0;"><a href="{{ route('home') }}"><img src="{{ asset('siteassets/img/logo.png') }}" alt=""></a></td>
              </tr>
               <!-- Header end-->

               <!-- Body -->
              <tr>
                  <td style="padding: 35px; background-color: #ffffff; border-radius: 0 0 4px 4px;">
                    <p style="padding: 0; margin: 0 0 20px 0;">Hello, {{ $user->name}}</p>
                    <p style="padding: 0; margin: 0 0 20px 0;">We are so excited to have you here!</p>
                    <p style="padding: 0; margin: 0 0 20px 0;">To finish activating your account, please click the button below</p>
                    <p style="padding: 0; margin: 0 0 20px 0;">
                      <a href="" target="_blank" style="text-decoration: none; background-color:#ec9f02; color:#ffffff; display:inline-block; border-radious:3px; padding: 12px 20px;">
                        Activate
                      </a>
                    </p>
                    <p style="padding: 0; margin: 0 0 20px 0;"><strong> This link is valid within 72 hours.</strong></p>
                    <p style="padding: 0; margin: 0 0 20px 0;">Cheers,<br>The Spectacle House Team</p>
                  </td>
              </tr>
              <!-- Body end-->

              <!-- Footer -->

              <!-- Footer end-->
            </table>

           </td>
         </tr>
    </table>
  </body>
