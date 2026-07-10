@extends('layout.main')@section('title', $title)
@section('content')

    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <div class="card card-custom card-transparent">
                    <div class="card-body p-0">
                        <!--begin: ویزارد-->
                        <div class="wizard wizard-4" id="kt_wizard_v4" data-wizard-state="step-first"
                             data-wizard-clickable="true">
                            <!--begin: ویزارد Nav-->
                            <div class="wizard-nav">
                                <div class="wizard-steps">
                                    <!--begin::ویزارد گام 1 Nav-->
                                    <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                        <div class="wizard-wrapper">
                                            <div class="wizard-number">
                                                1
                                            </div>
                                            <div class="wizard-label">
                                                <div class="wizard-title">
                                                    افزودن اکانت
                                                </div>
                                                <div class="wizard-desc">
                                                    ایجاد کردن سفارشی اکانت
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::ویزارد گام 1 Nav-->

                                    <!--begin::ویزارد گام 2 Nav-->
                                    <div class="wizard-step" data-wizard-type="step">
                                        <div class="wizard-wrapper">
                                            <div class="wizard-number">
                                                2
                                            </div>
                                            <div class="wizard-label">
                                                <div class="wizard-title">
                                                    شما نشانی
                                                </div>
                                                <div class="wizard-desc">
                                                    برپایی شما نشانی
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::ویزارد گام 2 Nav-->

                                    <!--begin::ویزارد گام 3 Nav-->
                                    <div class="wizard-step" data-wizard-type="step">
                                        <div class="wizard-wrapper">
                                            <div class="wizard-number">
                                                3
                                            </div>
                                            <div class="wizard-label">
                                                <div class="wizard-title">
                                                    پرداخت
                                                </div>
                                                <div class="wizard-desc">
                                                    روش پرداخت
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::ویزارد گام 3 Nav-->

                                    <!--begin::ویزارد گام 4 Nav-->
                                    <div class="wizard-step" data-wizard-type="step">
                                        <div class="wizard-wrapper">
                                            <div class="wizard-number">
                                                4
                                            </div>
                                            <div class="wizard-label">
                                                <div class="wizard-title">
                                                    تکمیل
                                                </div>
                                                <div class="wizard-desc">
                                                    بررسی و ارسال کنید
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::ویزارد گام 4 Nav-->
                                </div>
                            </div>
                            <!--end: ویزارد Nav-->

                            <!--begin: ویزارد Body-->
                            <div class="card card-custom card-shadowless rounded-top-0">
                                <div class="card-body p-0">
                                    <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                        <div class="col-xl-12 col-xxl-7">
                                            <!--begin: ویزارد Form-->
                                            <form class="form mt-0 mt-lg-10" id="kt_form">
                                                <!--begin: ویزارد گام 1-->
                                                <div class="pb-5" data-wizard-type="step-content"
                                                     data-wizard-state="current">
                                                    <div class="mb-10 font-weight-bold text-dark">جزییات اکانت خود را
                                                        وارد کنید
                                                    </div>
                                                    <!--begin::ورودی-->
                                                    <div class="form-group">
                                                        <label>نام</label>
                                                        <input type="text"
                                                               class="form-control form-control-solid form-control-lg"
                                                               name="fname" placeholder="نام" value="John"/>
                                                        <span class="form-text text-muted">لطفا نام خود را  وارد کنید</span>
                                                    </div>
                                                    <!--end::ورودی-->

                                                    <!--begin::ورودی-->
                                                    <div class="form-group">
                                                        <label>نام خانوادگی</label>
                                                        <input type="text"
                                                               class="form-control form-control-solid form-control-lg"
                                                               name="lname" placeholder="نام خانوادگی" value="Wick"/>
                                                        <span class="form-text text-muted">لطفا نام خانوادگی خود را وارد کنید</span>
                                                    </div>
                                                    <!--end::ورودی-->
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <!--begin::ورودی-->
                                                            <div class="form-group">
                                                                <label>تلفن</label>
                                                                <input type="tel"
                                                                       class="form-control form-control-solid form-control-lg"
                                                                       name="phone" placeholder="phone"
                                                                       value="+61412345678"/>
                                                                <span class="form-text text-muted">لطفا شمار تلفن خود را وارد کنید</span>
                                                            </div>
                                                            <!--end::ورودی-->
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <!--begin::ورودی-->
                                                            <div class="form-group">
                                                                <label>پست الکترونیک</label>
                                                                <input type="email"
                                                                       class="form-control form-control-solid form-control-lg"
                                                                       name="email" placeholder="پست الکترونیک"
                                                                       value="john.wick@reeves.com"/>
                                                                <span class="form-text text-muted">لطفا ایمیل خود را وارد کنید</span>
                                                            </div>
                                                            <!--end::ورودی-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end: ویزارد گام 1-->

                                                <!--begin: ویزارد گام 2-->
                                                <div class="pb-5" data-wizard-type="step-content">
                                                    <div class="mb-10 font-weight-bold text-dark">برپایی شما نشانی</div>
                                                    <!--begin::ورودی-->
                                                    <div class="form-group">
                                                        <label>آدرس 1</label>
                                                        <input type="text"
                                                               class="form-control form-control-solid form-control-lg"
                                                               name="address1" placeholder="آدرس 1" value="آدرس 1"/>
                                                        <span class="form-text text-muted">لطفا نشانی خود را وارد کنید</span>
                                                    </div>
                                                    <!--end::ورودی-->

                                                    <!--begin::ورودی-->
                                                    <div class="form-group">
                                                        <label>آدرس 2</label>
                                                        <input type="text"
                                                               class="form-control form-control-solid form-control-lg"
                                                               name="address2" placeholder="آدرس 2" value="آدرس 2"/>
                                                        <span class="form-text text-muted">لطفا نشانی خود را وارد کنید</span>
                                                    </div>
                                                    <!--end::ورودی-->
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <!--begin::ورودی-->
                                                            <div class="form-group">
                                                                <label>کد ارسال</label>
                                                                <input type="text"
                                                                       class="form-control form-control-solid form-control-lg"
                                                                       name="postcode" placeholder="کد ارسال"
                                                                       value="3000"/>
                                                                <span class="form-text text-muted">لطفا کد ارسال خود را وارد کنید.</span>
                                                            </div>
                                                            <!--end::ورودی-->
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <!--begin::ورودی-->
                                                            <div class="form-group">
                                                                <label>شهر</label>
                                                                <input type="text"
                                                                       class="form-control form-control-solid form-control-lg"
                                                                       name="state" placeholder="شهر" value="اصفهان"/>
                                                                <span class="form-text text-muted">لطفاً وارد شهر خود شوید.</span>
                                                            </div>
                                                            <!--end::ورودی-->
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <!--begin::ورودی-->
                                                            <div class="form-group">
                                                                <label>استان</label>
                                                                <input type="text"
                                                                       class="form-control form-control-solid form-control-lg"
                                                                       name="state" placeholder="استان" value="VIC"/>
                                                                <span class="form-text text-muted">لطفاً استان خود را وارد کنید</span>
                                                            </div>
                                                            <!--end::ورودی-->
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <!--begin::انتخاب-->
                                                            <div class="form-group">
                                                                <label>کشور</label>
                                                                <select name="country"
                                                                        class="form-control form-control-solid form-control-lg">
                                                                    <option value="">انتخاب</option>
                                                                    <option value="AF">افغانستان</option>
                                                                    <option value="AX">جزایر الند</option>
                                                                    <option value="AL">آلبانی</option>
                                                                    <option value="DZ">الجزایر</option>
                                                                    <option value="AS">آمریکا</option>
                                                                    <option value="AD">آندورا</option>
                                                                    <option value="AO">آنگولا</option>
                                                                    <option value="AI">آنگولا</option>
                                                                    <option value="AQ">جنوبگان</option>
                                                                    <option value="AG">آنتیگوا و باربودا</option>
                                                                    <option value="AR">آرژانتین</option>
                                                                    <option value="AM">ارمنستان</option>
                                                                    <option value="AW">آروبا</option>
                                                                    <option value="AU" selected>استرالیا</option>
                                                                    <option value="AT">اتریش</option>
                                                                    <option value="AZ">آذربایژوئن</option>
                                                                    <option value="BS">باهاما</option>
                                                                    <option value="BH">بحرین</option>
                                                                    <option value="BD">بنگلادش</option>
                                                                    <option value="BB">باربادوس</option>
                                                                    <option value="BY">بلاروس</option>
                                                                    <option value="BE">بلژیک</option>
                                                                    <option value="BZ">بلیز</option>
                                                                    <option value="BJ">بنین</option>
                                                                    <option value="BM">برمودا</option>
                                                                    <option value="BT">بوتان</option>
                                                                    Plurinational استان of</option>,
                                                                    Sint Eustatius and Saba</option>,
                                                                    <option value="BA">بوسنی و هرزگوین</option>
                                                                    <option value="BW">بوتسوانا</option>
                                                                    <option value="BV">جزیره بوت</option>
                                                                    <option value="BR">برزیل</option>
                                                                    <option value="IO">قلمرو اقیانوس هند انگلیس</option>
                                                                    <option value="BN">برونئی دارالسلام</option>
                                                                    <option value="BG">بلغارستان</option>
                                                                    <option value="BF">بورکینافاسو</option>
                                                                    <option value="BI">بوروندی</option>
                                                                    <option value="KH">کامبوج</option>
                                                                    <option value="CM">کامرون</option>
                                                                    <option value="CA">کانادا</option>
                                                                    <option value="CV">کیپ ورد</option>
                                                                    <option value="KY">جزایر کیمن</option>
                                                                    <option value="CF">جمهوری آفریقای مرکزی</option>
                                                                    <option value="TD">چاد</option>
                                                                    <option value="CL">شیلی</option>
                                                                    <option value="CN">چین</option>
                                                                    <option value="CX">جزیره کریسمس</option>
                                                                    <option value="CC">جزایر کوکو</option>
                                                                    <option value="CO">کلمبیا</option>
                                                                    <option value="KM">کومور</option>
                                                                    <option value="CG">کنگو</option>
                                                                    the نسخه ی نمایشیcratic Republic of the</option>,
                                                                    <option value="CK">جزایر کوک</option>
                                                                    <option value="CR">کاستاریکا</option>
                                                                    <option value="CI">ساحل عاج</option>
                                                                    <option value="HR">کرواسی</option>
                                                                    <option value="CU">کوبا</option>
                                                                    <option value="CW">کوراسائو</option>
                                                                    <option value="CY">قبرس</option>
                                                                    <option value="CZ">جمهوری چک</option>
                                                                    <option value="DK">دانمارک</option>
                                                                    <option value="DJ">جیبوتی</option>
                                                                    <option value="DM">دومینیکا</option>
                                                                    <option value="DO">دومینیکا</option>
                                                                    <option value="EC">اکوادور</option>
                                                                    <option value="EG">مصر</option>
                                                                    <option value="SV">السالوادور</option>
                                                                    <option value="GQ">گینه استوایی</option>
                                                                    <option value="ER">اریتره</option>
                                                                    <option value="EE">استونی</option>
                                                                    <option value="ET">اتیوپی</option>
                                                                    <option value="FK">جزایر فالکلند (مالویناس)</option>
                                                                    <option value="FO">جزایر فارو</option>
                                                                    <option value="FJ">فیجی</option>
                                                                    <option value="FI">فنلاند</option>
                                                                    <option value="FR">همدان</option>
                                                                    <option value="GF">فرانسه گویانا</option>
                                                                    <option value="PF">فرانسه پلینزی</option>
                                                                    <option value="TF">سرزمین های فرانسه</option>
                                                                    <option value="GA">گابن</option>
                                                                    <option value="GM">گامبیا</option>
                                                                    <option value="GE">جورجیا</option>
                                                                    <option value="DE">آلمانی</option>
                                                                    <option value="GH">غنا</option>
                                                                    <option value="GI">جبل الطارق</option>
                                                                    <option value="GR">یونان</option>
                                                                    <option value="GL">گرینلند</option>
                                                                    <option value="GD">گرنادا</option>
                                                                    <option value="GP">گوادلوپ</option>
                                                                    <option value="GU">گوام</option>
                                                                    <option value="GT">گواتمالا</option>
                                                                    <option value="GG">گورنسی</option>
                                                                    <option value="گ ن">گینه</option>
                                                                    <option value="GW">گینه بیساو</option>
                                                                    <option value="GY">گویان</option>
                                                                    <option value="HT">هائیتی</option>
                                                                    <option value="HM">جزایر هارد</option>
                                                                    <option value="VA">مقدس</option>
                                                                    <option value="HN">هندوراس</option>
                                                                    <option value="HK">هنگ کنگ</option>
                                                                    <option value="HU">مجارستان</option>
                                                                    <option value="IS">ایسلند</option>
                                                                    <option value="IN">هند</option>
                                                                    <option value="ID">اندونزی</option>
                                                                    Islamic Republic of</option>,
                                                                    <option value="IQ">عراق</option>
                                                                    <option value="IE">ایرلند</option>
                                                                    <option value="IM">جزیره من</option>
                                                                    <option value="IL">اسرائيل</option>
                                                                    <option value="IT">ایتالیا</option>
                                                                    <option value="JM">جامائیکا</option>
                                                                    <option value="JP">ژاپن</option>
                                                                    <option value="JE">جرسی</option>
                                                                    <option value="JO">اردن</option>
                                                                    <option value="KZ">قزاقستان</option>
                                                                    <option value="KE">کنیا</option>
                                                                    <option value="KI">کیریباتی</option>
                                                                    <option value="KP"> نسخه ی نمایشیcratic مردم's
                                                                        Republic of,
                                                                        Republic of
                                                                    </option>
                                                                    ,
                                                                    <option value="KW">کویت</option>
                                                                    <option value="KG">قرقیزستان</option>
                                                                    <option value="LA">جمهوری خلق</option>
                                                                    <option value="LV">لتونی</option>
                                                                    <option value="LB">لبنان</option>
                                                                    <option value="LS">لسوتو</option>
                                                                    <option value="LR">لیبریا</option>
                                                                    <option value="LY">لیبی</option>
                                                                    <option value="LI">لیختن اشتاین</option>
                                                                    <option value="LT">لیتوانی</option>
                                                                    <option value="LU">لوکزامبورگ</option>
                                                                    <option value="MO">ماکائو</option>
                                                                    the former Yugoslav Republic of</option>, the former
                                                                    Yugoslav
                                                                    <option value="MG">ماداگاسکار</option>
                                                                    <option value="MW">مالاوی</option>
                                                                    <option value="MY">مالزی</option>
                                                                    <option value="MV">مالدیو</option>
                                                                    <option value="ML">مالی</option>
                                                                    <option value="MT">مالت</option>
                                                                    <option value="MH">جزایر مارشال</option>
                                                                    <option value="MQ">مارتینیک</option>
                                                                    <option value="MR">موریتانی</option>
                                                                    <option value="MU">موریس</option>
                                                                    <option value="YT">مایوت</option>
                                                                    <option value="MX">مکزیک</option>
                                                                    Federated استانs of</option>,
                                                                    Republic of</option>,
                                                                    <option value="MC">موناکو</option>
                                                                    <option value="MN">مغولستان</option>
                                                                    <option value="ME">مونته نگرو</option>
                                                                    <option value="MS">مونتسرات</option>
                                                                    <option value="MA">مراکش</option>
                                                                    <option value="MZ">موزامبیک</option>
                                                                    <option value="MM">میانمار</option>
                                                                    <option value="NA">ناميبيا</option>
                                                                    <option value="NR">نائورو</option>
                                                                    <option value="NP">نپال</option>
                                                                    <option value="NL">هیرلند</option>
                                                                    <option value="NC">کالدونیا</option>
                                                                    <option value="NZ">نیوزیلند</option>
                                                                    <option value="NI">نیکاراگوئه</option>
                                                                    <option value="NE">نیجر</option>
                                                                    <option value="NG">نیجرia</option>
                                                                    <option value="NU">نیو</option>
                                                                    <option value="NF">جزیره نورفولک</option>
                                                                    <option value="م ح">جزایر ماریانای شمالی</option>
                                                                    <option value="NO">نروژ</option>
                                                                    <option value="OM">عمان</option>
                                                                    <option value="PK">پاکستان</option>
                                                                    <option value="PW">پالائو</option>
                                                                    <option value="PS"> Occupied,
                                                                    <option value="PA">پاناما</option>
                                                                    <option value="PG">گینه نو</option>
                                                                    <option value="PY">پاراگوئه</option>
                                                                    <option value="PE">پرو</option>
                                                                    <option value="PH">فیلیپین</option>
                                                                    <option value="PN">پیتکراین</option>
                                                                    <option value="PL">لهستان</option>
                                                                    <option value="PT">پرتغال</option>
                                                                    <option value="PR">پورتوریکو</option>
                                                                    <option value="QA">قطر</option>
                                                                    <option value="RE">ریئنون</option>
                                                                    <option value="RO">رومانی</option>
                                                                    <option value="RU">روسیه</option>
                                                                    <option value="RW">رواندا</option>
                                                                    <option value="BL">سنت بارتلی</option>
                                                                    Ascension and Tristan da Cunha</option>,
                                                                    <option value="KN">سنت کیتس و نوویس</option>
                                                                    <option value="LC">سنت لوسیا</option>
                                                                    <option value="MF">سنت مارتین</option>
                                                                    <option value="PM">سنت پیر</option>
                                                                    <option value="VC">سنت وینسنت</option>
                                                                    <option value="WS">ساموآ</option>
                                                                    <option value="س م">سن مارینو</option>
                                                                    <option value="ST">سائو تومه و پرینسیپ</option>
                                                                    <option value="SA">عربستان سعودی</option>
                                                                    <option value="SN">سنگال</option>
                                                                    <option value="RS">صربستان</option>
                                                                    <option value="SC">سیشل</option>
                                                                    <option value="SL">سیرا لئون</option>
                                                                    <option value="SG">سنگاپور</option>
                                                                    <option value="SX">مارتین</option>
                                                                    <option value="SK">اسلواکی</option>
                                                                    <option value="SI">اسلوونی</option>
                                                                    <option value="SB">جزایر سلیمان</option>
                                                                    <option value="SO">سومالی</option>
                                                                    <option value="ZA">آفریقای جنوبی</option>
                                                                    <option value="GS">جورجیا جنوبی</option>
                                                                    <option value="SS">سودان جنوبی</option>
                                                                    <option value="ES">اسپانیا</option>
                                                                    <option value="LK">سری لانکا</option>
                                                                    <option value="SD">سودان</option>
                                                                    <option value="SR">سورینام</option>
                                                                    <option value="SJ">سوالبارد و ژوئن مین</option>
                                                                    <option value="SZ">سوازیلند</option>
                                                                    <option value="SE">سوئد</option>
                                                                    <option value="CH">سوئیس</option>
                                                                    <option value="SY">جمهوری عربی سوریه</option>
                                                                    <option value="TW"> Province of چین,
                                                                    <option value="TJ">تاجیکستان</option>
                                                                    United Republic of</option>, United
                                                                    <option value="TH">تایلند</option>
                                                                    <option value="TL">تیمور-لست</option>
                                                                    <option value="TG">رفتن</option>
                                                                    <option value="TK">توکلو</option>
                                                                    <option value="TO">تونگا</option>
                                                                    <option value="TT">ترینیداد و توباگو</option>
                                                                    <option value="TN">تونس</option>
                                                                    <option value="TR">بوقلمون</option>
                                                                    <option value="TM">ترکمنستان</option>
                                                                    <option value="TC">جزایر تورکس و کایکوس</option>
                                                                    <option value="TV">تووالو</option>
                                                                    <option value="UG">اوگاندا</option>
                                                                    <option value="UA">اوکراین</option>
                                                                    <option value="AE">امارات متحده عربی</option>
                                                                    <option value="GB">انگلستان</option>
                                                                    <option value="US">استان متحده</option>
                                                                    <option value="UM">جزایر کوچک</option>
                                                                    <option value="UY">اروگوئه</option>
                                                                    <option value="UZ">ازبکستان</option>
                                                                    <option value="VU">واناتو</option>
                                                                    Bolivarian Republic of</option>, Bolivarian
                                                                    <option value="VN">ویتنام</option>
                                                                    British</option>,
                                                                    U.S.</option>,
                                                                    <option value="WF">والیس و فوتونا</option>
                                                                    <option value="EH">صحرای غربی</option>
                                                                    <option value="YE">یمن</option>
                                                                    <option value="ZM">زامبیا</option>
                                                                    <option value="ZW">زیمبابوه</option>
                                                                </select>
                                                            </div>
                                                            <!--end::انتخاب-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end: ویزارد گام 2-->

                                                <!--begin: ویزارد گام 3-->
                                                <div class="pb-5" data-wizard-type="step-content">
                                                    <div class="mb-10 font-weight-bold text-dark">جزییات پرداخت را وارد
                                                        کنید
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <!--begin::ورودی-->
                                                            <div class="form-group">
                                                                <label>نام روی کارت</label>
                                                                <input type="text"
                                                                       class="form-control form-control-solid form-control-lg"
                                                                       name="ccname" placeholder="نام کارت"
                                                                       value="John Wick"/>
                                                                <span class="form-text text-muted">لطفا وارد کنید نام کارت.</span>
                                                            </div>
                                                            <!--end::ورودی-->
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <!--begin::ورودی-->
                                                            <div class="form-group">
                                                                <label>شماره کارت</label>
                                                                <input type="text"
                                                                       class="form-control form-control-solid form-control-lg"
                                                                       name="ccnumber" placeholder="شماره کارت"
                                                                       value="4444 3333 2222 1111"/>
                                                                <span class="form-text text-muted">لطفا نشانی خود را وارد کنید</span>
                                                            </div>
                                                            <!--end::ورودی-->
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-4">
                                                            <!--begin::ورودی-->
                                                            <div class="form-group">
                                                                <label>منقضی شدن کارت ماه</label>
                                                                <input type="number"
                                                                       class="form-control form-control-solid form-control-lg"
                                                                       name="ccmonth" placeholder="منقضی شدن کارت ماه"
                                                                       value="01"/>
                                                                <span class="form-text text-muted">لطفا وارد کنید منقضی شدن کارت ماه.</span>
                                                            </div>
                                                            <!--end::ورودی-->
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <!--begin::ورودی-->
                                                            <div class="form-group">
                                                                <label>منقضی شدن کارت سال</label>
                                                                <input type="number"
                                                                       class="form-control form-control-solid form-control-lg"
                                                                       name="ccyear" placeholder="Card Expire سال"
                                                                       value="21"/>
                                                                <span class="form-text text-muted">لطفا وارد کنید منقضی شدن کارت سال.</span>
                                                            </div>
                                                            <!--end::ورودی-->
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <!--begin::ورودی-->
                                                            <div class="form-group">
                                                                <label>شماره CVV کارت</label>
                                                                <input type="password"
                                                                       class="form-control form-control-solid form-control-lg"
                                                                       name="cccvv" placeholder="شماره CVV کارت"
                                                                       value="123"/>
                                                                <span class="form-text text-muted">لطفا وارد کنید شماره CVV کارت.</span>
                                                            </div>
                                                            <!--end::ورودی-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end: ویزارد گام 3-->

                                                <!--begin: ویزارد گام 4-->
                                                <div class="pb-5" data-wizard-type="step-content">
                                                    <!--begin::Section-->
                                                    <h4 class="mb-10 font-weight-bold text-dark">بررسی کنید و ارسال
                                                        کنید</h4>
                                                    <h6 class="font-weight-bolder mb-3">
                                                        فعلی نشانی:
                                                    </h6>
                                                    <div class="text-dark-50 line-height-lg">
                                                        <div>آدرس 1</div>
                                                        <div>آدرس 2</div>
                                                        <div>اصفهان 3000, VIC, استرالیا</div>
                                                    </div>
                                                    <div class="separator separator-dashed my-5"></div>
                                                    <!--end::Section-->

                                                    <!--begin::Section-->
                                                    <h6 class="font-weight-bolder mb-3">
                                                        جزئیات تحویل:
                                                    </h6>
                                                    <div class="text-dark-50 line-height-lg">
                                                        <div>بسته بندی: ایستگاه کاری کامل (مانیتور ، کامپیوتر ، صفحه
                                                            کلید و ماوس)
                                                        </div>
                                                        <div>وزن: 25 کیلوگرم</div>
                                                        <div>ابعاد: 110cm (w) x 90cm (h) x 150cm (L)</div>
                                                    </div>
                                                    <div class="separator separator-dashed my-5"></div>
                                                    <!--end::Section-->

                                                    <!--begin::Section-->
                                                    <h6 class="font-weight-bolder mb-3">
                                                        نوع تحویل:
                                                    </h6>
                                                    <div class="text-dark-50 line-height-lg">
                                                        <div>شبانه تحویل با تنظیم منظم</div>
                                                        <div>صبح ترجیحی (8:00 صبح - 11:00 صبح) تحویل</div>
                                                    </div>
                                                    <div class="separator separator-dashed my-5"></div>
                                                    <!--end::Section-->

                                                    <!--begin::Section-->
                                                    <h6 class="font-weight-bolder mb-3">
                                                        نشانی تحویل:
                                                    </h6>
                                                    <div class="text-dark-50 line-height-lg">
                                                        <div>آدرس 1</div>
                                                        <div>آدرس 2</div>
                                                        <div>پرستون 3072, VIC, استرالیا</div>
                                                    </div>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end: ویزارد گام 4-->

                                                <!--begin: ویزارد اقدامات-->
                                                <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                                    <div class="mr-2">
                                                        <button type="button"
                                                                class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4"
                                                                data-wizard-type="action-prev">
                                                            قبلی
                                                        </button>
                                                    </div>
                                                    <div>
                                                        <button type="button"
                                                                class="btn btn-success font-weight-bold text-uppercase px-9 py-4"
                                                                data-wizard-type="action-submit">
                                                            ارسال
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-primary font-weight-bold text-uppercase px-9 py-4"
                                                                data-wizard-type="action-next">
                                                            بعد
                                                        </button>
                                                    </div>
                                                </div>
                                                <!--end: ویزارد اقدامات-->
                                            </form>
                                            <!--end: ویزارد Form-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: ویزارد Bpdy-->
                        </div>
                        <!--end: ویزارد-->
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->

@endsection
