<div id="contact" class="paddsection">
  <div class="container">
    <div class="contact-block1">
      <div class="row">

        <div class="col-lg-6">
          <div class="contact-contact">

            <h2 class="mb-30">Liên Hệ Tôi</h2>

            <ul class="contact-details">
              <li><span>304 Lê Văn Hiến, Street</span></li>
              <li><span>Đà Nẵng , Việt Nam</span></li>
              <li><span>+84 935.410.769</span></li>
              <li><span>truongbahanguyen@gmail.com</span></li>
            </ul>

          </div>
        </div>

        <div class="col-lg-6">
          <form action="" method="post" role="form" class="contactForm">
            @csrf
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group contact-block1">
                  <input type="text" name="name_contact" class="form-control" id="name_contact" placeholder="Tên của bạn" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email_contact" placeholder="Email của bạn" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="12" id="message_contact" data-msg="Please write something for us" placeholder="Tin Nhắn"></textarea>
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-lg-12">
                <input type="submit" class="btn btn-defeault btn-send" value="Send message">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>