<!DOCTYPE html>
            <html>
            <head>
                <title>Contact Us Client Details</title>
            </head>
            <body> 
                <table style="width:100%;border: 1px solid black;">
                      <tr>
                        <th style="border: 1px solid black;">Title</th>
                        <th style="border: 1px solid black;">Details</th> 
                      </tr>
                      <tr>
                        <td style="border: 1px solid black;">Name</td>
                        <td style="border: 1px solid black;">{!! $name !!}</td>
                      </tr>
                      <tr>
                        <td style="border: 1px solid black;">Email</td>
                        <td style="border: 1px solid black;">{!! $email !!}</td>
                      </tr>
                      <tr>
                        <td style="border: 1px solid black;">Subject</td>
                        <td style="border: 1px solid black;">{!! $subject !!}</td>
                      </tr>
                      <tr>
                        <td style="border: 1px solid black;">Message</td>
                        <td style="border: 1px solid black;">{!! $msg !!}</td>
                      </tr>
                    </table>
            </body>
            </html>