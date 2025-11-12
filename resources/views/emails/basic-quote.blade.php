<!DOCTYPE html>
<html>
<head>
    <title>New Quote Request - PrintHelp</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #f9f9f9; padding: 20px; border-radius: 10px; }
        .header { background: #2c3e50; color: white; padding: 20px; text-align: center; border-radius: 5px; margin-bottom: 20px; }
        .section { background: white; padding: 15px; margin-bottom: 15px; border-radius: 5px; border-left: 4px solid #3498db; }
        .field { margin-bottom: 10px; padding: 5px 0; }
        .label { font-weight: bold; color: #555; display: inline-block; width: 120px; }
        .value { color: #333; }
        .product-section { background: #e8f4fd; border-left-color: #e74c3c; }
        .message-box { background: #f8f9fa; padding: 15px; border-radius: 5px; margin-top: 10px; border: 1px solid #ddd; }
        .footer { text-align: center; margin-top: 20px; padding: 15px; background: #34495e; color: white; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0;">📧 New Quote Request</h1>
            <p style="margin: 5px 0 0 0;">PrintHelp Customer Inquiry</p>
        </div>
        
        <!-- Product Information -->
        @if(!empty($data['product_name']))
        <div class="section product-section">
            <h3 style="margin-top: 0; color: #e74c3c;">🛍️ Product Information</h3>
            
            <div class="field">
                <span class="label">Product Name:</span>
                <span class="value"><strong>{{ $data['product_name'] }}</strong></span>
            </div>

            @if(!empty($data['product_price']))
            <div class="field">
                <span class="label">Price:</span>
                <span class="value" style="color: #e74c3c; font-weight: bold;">{{ $data['product_price'] }}</span>
            </div>
            @endif

            @if(!empty($data['product_id']))
            <div class="field">
                <span class="label">Product ID:</span>
                <span class="value">{{ $data['product_id'] }}</span>
            </div>
            @endif

            @if(!empty($data['product_url']))
            <div class="field">
                <span class="label">Product URL:</span>
                <span class="value">
                    <a href="{{ url($data['product_url']) }}" style="color: #3498db; text-decoration: none;">
                        🔗 View Product
                    </a>
                </span>
            </div>
            @endif
        </div>
        @endif

        <!-- Customer Information -->
        <div class="section">
            <h3 style="margin-top: 0; color: #2c3e50;">👤 Customer Information</h3>
            
            <div class="field">
                <span class="label">Name:</span>
                <span class="value">{{ $data['name'] }}</span>
            </div>
            
            <div class="field">
                <span class="label">Email:</span>
                <span class="value">{{ $data['email'] }}</span>
            </div>
            
            <div class="field">
                <span class="label">Phone:</span>
                <span class="value">{{ $data['phone'] }}</span>
            </div>
            
            <div class="field">
                <span class="label">Subject:</span>
                <span class="value">{{ $data['subject'] }}</span>
            </div>
            
            <div class="field">
                <span class="label" style="vertical-align: top;">Message:</span>
                <div class="message-box">
                    {{ $data['message'] }}
                </div>
            </div>
        </div>

        <div class="section">
            <div class="field">
                <span class="label">Submitted:</span>
                <span class="value">{{ now()->format('F j, Y \a\t g:i A') }}</span>
            </div>
        </div>
        
        <div class="footer">
            <p style="margin: 0;">This email was sent from your website quote request form.</p>
            <p style="margin: 5px 0 0 0; font-size: 12px;">&copy; {{ date('Y') }} PrintHelp. All rights reserved.</p>
        </div>
    </div>
</body>
</html>