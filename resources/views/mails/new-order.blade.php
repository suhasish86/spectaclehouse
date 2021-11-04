<body style="background-color: #f6f6f6;">
    <table align="center"
        style="font-family: Arial, Helvetica, sans-serif; font-size: 17px; color: #000000; max-width: 600px; margin: 0 auto;">
        <tr>
            <td>
                <table width="100%">
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #ec9f02; padding: 10px 35px; border-radius: 4px 4px 0 0;"><a
                                href="{{ route('home') }}"><img src="{{ asset('siteassets/img/logo.png') }}"
                                    alt=""></a></td>
                    </tr>
                    <!-- Header end-->

                    <!-- Body -->
                    <tr>
                        <td style="padding: 35px; background-color: #ffffff; border-radius: 0 0 4px 4px;">
                            <p style="padding: 0; margin: 0 0 20px 0;">Hello, {{ $mail_data->order->billing_address->name }}</p>
                            <p style="padding: 0; margin: 0 0 20px 0;">We are so excited to have you here!</p>
                            <p style="padding: 0; margin: 0 0 20px 0;">Order recieved successfuly! </p>

                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>SKU</th>
                                        <th width="80">Quantity</th>
                                        <th>Price (₹)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mail_data->cart as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-row align-items-center">
                                                    <div>
                                                        <div class="cartImg"><img
                                                                src="{{ $item->attributes->image }}" alt=""></div>
                                                    </div>
                                                    <div>
                                                        <div class="cartProName">{{ $item->name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->attributes->sku }}</td>
                                            <td>
                                                {{ $item->quantity }}
                                            </td>
                                            <td>{{ $item->price }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">Order is empty</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <p style="padding: 0; margin: 0 0 20px 0;">One of our representative will contact you soon.</p>
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
