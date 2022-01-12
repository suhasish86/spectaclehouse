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
                    <p style="padding: 0; margin: 0 0 20px 0;">Hello, Spectacle House Admin</p>
                    <p style="padding: 0; margin: 0 0 20px 0;">You have a contact request from your website as follows</p>

                    <table>
                        <tr>
                            <td>Name: </td>
                            <td style="float: left;">{{ $user['contact_name'] }}</td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td style="float: left;">{{ $user['contact_email'] }}</td>
                        </tr>
                        <tr>
                            <td>Phone: </td>
                            <td style="float: left;">{{ $user['contact_phone'] }}</td>
                        </tr>
                        <tr>
                            <td>Message: </td>
                            <td style="float: left;">{{ $user['contact_message'] }}</td>
                        </tr>
                    </table>

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
