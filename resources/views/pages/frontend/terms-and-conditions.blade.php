@extends('layouts.frontend.master')

@section('title', 'Privacy Policy')

@section('content')
        <div class="bodyWrapper flex-grow-1">
            <section class="subheader py-5">
                <div class="container py-lg-5">
                    <div class="row py-lg-4">
                        <div class="col-md-6 text-white">
                            <h1>Terms & Conditions</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="policy_sec py-5 border-bottom">
                <div class="container py-lg-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="inner_content">
                                <p>A Terms & Conditions is a legal statement found on a website or app that outlines explicit details on how it will use personal data provided by users. Such personal data may include details like names, addresses, phone numbers, date of birth or data related to one's financial information like credit card details.</p>
                                <p>Other than outlining how your website will use the data, a Terms & Conditions also describes the legal obligations you have if you fail to meet stipulated responsibilities as the website owner.</p>
                                <p>As a business owner who's considering putting up a website, this article will give you a basic understanding of why you need to have a Terms & Conditions and how you should incorporate one.</p>
                                <p>As part of an array of privacy laws available across the globe, if your website will collect user information, you are legally required to have a Terms & Conditions in place.</p>
                                <p>If you are a resident member of the EU, having a Terms & Conditions shows compliance with the General Data Protection Regulation(GDPR). Failure to comply with this EU regulation can lead to a fine of up to 20 million Euros according to<span>&nbsp;</span>Intersoft Consulting.</p>
                                <p>The U.S., on the other hand, doesn't have a singular governing data protection legislation. Rather, the U.S. uses a combination of related data privacy laws at the federal and state level.</p>
                                <p>For instance, the Federal Trade Commission Act (FTCA) empowers the Federal Trade Commission to enforce privacy and data protection laws in federal jurisdiction. On the other hand, the California Online Privacy Protection Act (CalOPPA) is one such<span>&nbsp;</span>data privacy law<span>&nbsp;</span>which protects users with residency in California.</p>
                                <p>A Terms & Conditions also instils trust into users that their information is safe from unrelated parties. If not, you might be liable to legal repercussions. In general, a Terms & Conditions further legitimises your business by ensuring all the parties involved are part of a legally binding agreement.</p>
                                <p>Having a strong Terms & Conditions also offers a substantial competitive advantage. We don't precisely understand how Google's search algorithm works, but the biggest consensus is that if Google trusts your business, the higher your chances of appearing on its first search results pages.</p>
                                <p>According to<span>&nbsp;</span>Woorank, most SEO experts believe that a website's Terms & Conditions has a pivotal role to play in how Google and other search engines ultimately identify you as "trust-worthy."</p>
                                
                                <div class="space py-3"></div>

                                <h4>What to Include in Your Terms & Conditions</h4>
                                <p>The content of your Terms & Conditions will largely depend on the function of your website, the information gathered and how you intend to use said information. However, to pass legal standards, all Privacy policies should have these basic elements within the text.</p>
                                
                                <div class="space py-3"></div>
                                
                                <h4>Your Business Contact Information</h4>
                                <p>Your Privacy needs to display your organization details like the legal name, contact details and place of business. Best practice recommends that this part should appear as the first or the last part of your Terms & Conditions for visibility.</p>
                                
                                <div class="space py-3"></div>
                                
                                <h4>The Type of Data You Will Collect</h4>
                                <p>This ranges from emails, physical and IP addresses, credit card details, phone numbers or tracking locations. CalOPPA goes a step further to mandate that commercial or online websites collecting information on California residents must categorically list the type of personal information collected.</p>
                                
                                <div class="space py-3"></div>
                                
                                <h4>How You Will Collect the Information</h4>
                                <p>In addition to filling out forms, you can also collect data automatically through the use of cookies. Internet cookies are, by far, the easiest way to collect user data since browsers collect and save information from an array of sites users have previously visited. However, you must also obtain consent from users to use their cookies when collecting information.</p>
                                
                                <div class="space py-3"></div>
                                
                                <h4>How You Intend to Use the Data</h4>
                                <p>A vital element of a Terms & Conditions is describing how you intend to use the data collected. This clause is particularly important if third-parties like advertising programs or fintech companies are in the loop.</p>
                                <p>Will you use the data for transactional purposes alone or will you also send newsletters to your visitors? Will your company share information with other third-party entities like merchants? If so, the law legally requires you to list down all the relevant parties who will also have access to user information alongside your business.</p>
                                <p>In Quora's Terms & Conditions, they have explained in great detail how they intend to use user information, and even further clarifying that they do not sell to third parties:</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="features_sec py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-6 col-xl-3 my-3">
                            <div class="feature_box">
                                <div class="feature_icon">
                                    <img src="{{ asset('assets/frontend/images/sicon1.svg') }}" alt="Complimentary Shipping" class="img-fluid" />
                                </div>
                                <h4>Complimentary Shipping</h4>
                                <p>Free worldwide shipping and returns - customs and duties taxes included.</p>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 my-3">
                            <div class="feature_box">
                                <div class="feature_icon">
                                    <img src="{{ asset('assets/frontend/images/sicon2.svg') }}" alt="Customer service" class="img-fluid" />
                                </div>
                                <h4>Customer service</h4>
                                <p>We are available from Monday-Friday to answer your questions.</p>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 my-3">
                            <div class="feature_box">
                                <div class="feature_icon">
                                    <img src="{{ asset('assets/frontend/images/sicon3.svg') }}" alt="Secure payment" class="img-fluid" />
                                </div>
                                <h4>Secure payment</h4>
                                <p>Your payment information is processed securely.</p>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 my-3">
                            <div class="feature_box">
                                <div class="feature_icon">
                                    <img src="{{ asset('assets/frontend/images/sicon4.svg') }}" alt="Contact us" class="img-fluid" />
                                </div>
                                <h4>Contact us</h4>
                                <p>Need to contact us? Send us an e-mail at support@printhelp.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

@endsection