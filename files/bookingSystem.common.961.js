"use strict";
((typeof self !== 'undefined' ? self : this)["webpackChunkrestaurant_food_reservation"] = (typeof self !== 'undefined' ? self : this)["webpackChunkrestaurant_food_reservation"] || []).push([[961],{

/***/ 74961:
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

// ESM COMPAT FLAG
__webpack_require__.r(__webpack_exports__);

// EXPORTS
__webpack_require__.d(__webpack_exports__, {
  "default": function() { return /* binding */ LoginRegister; }
});

;// CONCATENATED MODULE: ./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/loaders/templateLoader.js??ruleSet[1].rules[3]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../drupal-vuejs/src/App/components/LoginRegister.vue?vue&type=template&id=77b94591&
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c('ValidationObserver', {
    ref: "formValidate",
    attrs: {
      "tag": "form"
    }
  }, [_c('div', {
    staticClass: "login-page",
    attrs: {
      "facebook_app_is_define": _vm.facebook_app_is_define
    }
  }, [_vm.alertDisplay ? _c('div', {
    staticClass: "alert w-100",
    class: _vm.alertType,
    attrs: {
      "role": "alert"
    },
    domProps: {
      "innerHTML": _vm._s(_vm.alertText)
    }
  }) : _vm._e(), _vm.isBusy ? _c('div', {
    staticClass: "spinner-grow text-primary",
    staticStyle: {
      "width": "3rem",
      "height": "3rem"
    },
    attrs: {
      "role": "status"
    }
  }, [_c('span', {
    staticClass: "sr-only"
  }, [_vm._v("Chargement ...")])]) : _vm._e(), _c('transition', {
    attrs: {
      "name": "customslide"
    }
  }, [_c('div', {
    staticClass: "block-center"
  }, [_c(_vm.stepe, {
    tag: "component",
    attrs: {
      "urlLogo": _vm.urlLogo,
      "formValidate": _vm.formValidate,
      "action-after-login": _vm.actionAfterLogin,
      "model-register-form": _vm.modelRegisterForm,
      "show-password": _vm.showPassword,
      "action-after-register": _vm.actionAfterRegister,
      "show-modal-success": _vm.showModalSuccess,
      "configs_login_rx_vuejs": _vm.configs_login_rx_vuejs
    },
    on: {
      "select-stepe": _vm.selectStepe
    }
  })], 1)])], 1), _c('div', {
    staticClass: "politik-secur mx-auto text-center"
  }, [_vm._t("condition_utilisation", function () {
    return [_vm.configs_login_rx_vuejs && _vm.configs_login_rx_vuejs.texts && _vm.configs_login_rx_vuejs.texts.condition_utilisation ? _c('div', {
      domProps: {
        "innerHTML": _vm._s(_vm.configs_login_rx_vuejs.texts.condition_utilisation.value)
      }
    }) : _vm._e()];
  })], 2)]);
};
var staticRenderFns = [];

// EXTERNAL MODULE: ../drupal-vuejs/node_modules/core-js/modules/es.array.push.js
var es_array_push = __webpack_require__(45251);
// EXTERNAL MODULE: external {"commonjs":"vue","commonjs2":"vue","root":"Vue"}
var external_commonjs_vue_commonjs2_vue_root_Vue_ = __webpack_require__(13797);
var external_commonjs_vue_commonjs2_vue_root_Vue_default = /*#__PURE__*/__webpack_require__.n(external_commonjs_vue_commonjs2_vue_root_Vue_);
// EXTERNAL MODULE: ../wbuutilities/index.js + 71 modules
var wbuutilities = __webpack_require__(49621);
;// CONCATENATED MODULE: ../drupal-vuejs/src/App/components/config_for_all.js
// Contient les methodes et attributs utilisé par toutes les sous modules.
/* harmony default export */ var config_for_all = ({
  /**
   *
   * @param {String} action
   * @param {Object} resp
   */
  AfterRedirect(action = "reload", url_redirect = null, resp = null) {
    console.log("AfterRedirect action .", action);
    var stepe = null;
    /**
     * Pour forcer la rediction.
     */
    if (action == "redirect" && url_redirect) {
      //
    } else if (action == "home") {
      window.location.assign("/");
    }
    // Reload current page.
    else if (action == "reload") {
      window.location.reload();
    }
    // Emit event when is finnish.
    else if (action == "emit_even") {
      var event = new CustomEvent("login_rx_vuejs__user_is_login");
      document.dispatchEvent(event);
    }
    // emits an event after creating an account
    else if (action == "emit_even_register") {
      var event = new CustomEvent("login_rx_vuejs__user_is_register");
      document.dispatchEvent(event);
    }
    // Comportement par defaut.
    else if (action == "default") {
      // --; Si l'utilisateur est redirigé vers une autre url.
      if (resp.reponse && resp.reponse.config.url !== resp.reponse.request.responseURL) {
        window.location.assign(resp.reponse.request.responseURL);
      }
      // On demande la creation d'un utilisateur.
      else if (resp.data && resp.data.createuser) {
        stepe = "final-gl-register";
      }
      // On recharge la meme page.
      else if (resp.data) {
        window.location.reload();
      }
    }
    return stepe;
  }
});
// EXTERNAL MODULE: ../drupal-vuejs/src/App/utilities.js + 1 modules
var utilities = __webpack_require__(13431);
;// CONCATENATED MODULE: ../drupal-vuejs/src/App/components/config.js





const vm = new (external_commonjs_vue_commonjs2_vue_root_Vue_default())();
/* harmony default export */ var config = ({
  ...config_for_all,
  messages: {
    log_email: "Email ou Nom d'utilisateur",
    pass: "Mot de passe",
    login: "Nom d'utilisateur",
    mail: "Email",
    submit: {
      first: "Suivant",
      connect: "Connexion",
      register: "S'inscrire",
      final: "terminée"
    },
    devis_create_user: "Votre compte a été creer sur <a href='/'> lesroisdelareno.fr </a>. <br> <strong> Bien vouloir verifier votre boite mail afin de valider votre compte </strong>"
  },
  modalSuccess(body, conf) {
    return wbuutilities/* AjaxToastBootStrap.modalSuccess */.Ht.modalSuccess(body, conf);
  },
  /**
   *
   * @param {Array} text
   * @returns
   */
  msgCreate(texts) {
    var h = vm.$createElement;
    const text = [];
    for (const i in texts) {
      text.push(h("p", {
        domProps: {
          innerHTML: texts[i]
        },
        style: {
          lineHeight: "25px",
          fontSize: "17px",
          padding: "15px 15px 0px",
          margin: 0
        }
      }, []));
    }
    return h("div", {}, [text]);
  },
  /**
   * Essaie de connecter l'utilisateur
   * @param {*} form
   */
  connexionUser(form, actionAfterLogin) {
    return new Promise((resolv, reject) => {
      let url = "/login-rx-vuejs/user-connexion";
      utilities/* default.post */.Z.post(url, form).then(resp => {
        this.AfterRedirect(actionAfterLogin, null, resp);
        resolv(resp);
      }).catch(er => {
        reject(er);
      });
    });
  }
});
// EXTERNAL MODULE: ../drupal-vuejs/src/config.js
var src_config = __webpack_require__(30236);
;// CONCATENATED MODULE: ../drupal-vuejs/src/App/rx/facebook.js
//const FB = window.Fb;
/* harmony default export */ var facebook = ({
  user: {},
  FB: null,
  appId: "",
  scope: "public_profile, email",
  version: "v11.0",
  /**
   * Ouverture de la boite de dislogue, facebook.
   */
  openPopup() {
    var self = this;
    window.FB.login(resp => {
      this.statusChangeCallback(resp, true);
    }, {
      scope: self.scope,
      return_scopes: true
    });
  },
  logOut() {
    window.FB.logout(function (res) {
      this.onLogOut(res);
    });
  },
  onLogOut(resp) {
    console.log("Déconnetion réussi", resp);
  },
  /**
   * Permet de definir les informations de base et emet un evenement
   * $event 'wbu-fb-status-change'
   * @param {*} r
   */
  statusChangeCallback(r, getInfoUser = false) {
    this.user = r;
    if (getInfoUser) {
      var event = new CustomEvent("wbu-fb-status-change");
      document.dispatchEvent(event);
    }
    console.log("status", this.user);
  },
  getUserStatus() {
    var self = this;
    window.FB.getLoginStatus(function (response) {
      self.statusChangeCallback(response);
    });
  },
  chargement() {
    var self = this;
    var head = document.getElementsByTagName("head")[0];
    var js = document.createElement("script");
    head.appendChild(js);
    js.id = "facebook-jssdk-021";
    // js.addEventListener("load", () => {
    //   console.log("Chargement du JS FACEBOOK END;");
    // });
    //
    js.onload = function () {
      function checkFB() {
        if (window.FB) {
          self.FB = window.FB;
          self.FB.init({
            appId: self.appId,
            cookie: true,
            xfbml: true,
            version: self.version,
            statue: false
          });
          console.log("Chargement du JS facebook");
          self.getUserStatus();
        } else {
          console.log("facebook not load");
          setTimeout(() => {
            checkFB();
          }, 900);
        }
      }
      checkFB();
    };
    js.src = "https://connect.facebook.net/en_US/sdk.js";
  }
});

/*
window.fbAsyncInit = function () {
  FB.init({
    appId: "344690973822888",
    cookie: true,
    xfbml: true,
    version: "v11.0",
  });
  FB.AppEvents.logPageView();
  Facebook.getUserStatus();
};
// Etape1 : chargement.
(function (d, s, id) {
  var js,
    fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {
    return;
  }
  js = d.createElement(s);
  js.id = id;
  js.src = "https://connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
})(document, "script", "facebook-jssdk");
/**/
;// CONCATENATED MODULE: ./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/loaders/templateLoader.js??ruleSet[1].rules[3]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../drupal-vuejs/src/App/components/CheckStatus.vue?vue&type=template&id=0d56cd7c&
var CheckStatusvue_type_template_id_0d56cd7c_render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c('div', {
    staticClass: "content-center"
  }, [_c('a', {
    staticClass: "content-center__img",
    attrs: {
      "href": "/"
    }
  }, [_c('img', {
    staticClass: "img-fluid",
    attrs: {
      "src": _vm.urlLogo,
      "alt": ""
    }
  })]), _c('h4', {
    staticClass: "title"
  }, [_vm._v("Connectez vous avec")]), _c('div', {
    staticClass: "content-center__btn-column"
  }, [_c('logingoogle', {
    attrs: {
      "idHtml": "default",
      "action-after-login": _vm.actionAfterLogin
    }
  }), _c('div', {
    staticClass: "btn-login btn-login--facebook",
    on: {
      "click": _vm.loginFacebook
    }
  }, [_c('span', {
    staticClass: "btn-login__icon icon-facebook"
  }), _c('i', {
    staticClass: "btn-login__text"
  }, [_vm._v(" Facebook ")]), _vm.waiting === 'facebook' ? _c('svgWaiting') : _vm._e()], 1)], 1), _c('strong', {
    staticClass: "d-block"
  }, [_vm._v(" Ou ")]), _c('hr', {
    staticClass: "diviseur"
  }), _c('h3', {
    staticClass: "content-center__title"
  }, [_vm._v(_vm._s(_vm.messages.log_email))]), _c('div', {
    staticClass: "form-group content-center__input"
  }, [_c('ValidationProvider', {
    attrs: {
      "name": "name",
      "rules": "required"
    },
    scopedSlots: _vm._u([{
      key: "default",
      fn: function (v) {
        return [_c('input', {
          directives: [{
            name: "model",
            rawName: "v-model",
            value: _vm.form.name[0].value,
            expression: "form.name[0].value"
          }],
          staticClass: "form-control",
          attrs: {
            "type": "text",
            "name": "name"
          },
          domProps: {
            "value": _vm.form.name[0].value
          },
          on: {
            "input": function ($event) {
              if ($event.target.composing) return;
              _vm.$set(_vm.form.name[0], "value", $event.target.value);
            }
          }
        }), _c('div', {
          staticClass: "text-danger text-small"
        }, _vm._l(v.errors, function (error, ii) {
          return _c('small', {
            key: ii,
            staticClass: "d-block"
          }, [_vm._v(" " + _vm._s(error) + " ")]);
        }), 0)];
      }
    }])
  })], 1), _c('div', {
    staticClass: "content-center__btn"
  }, [_c('div', {
    staticClass: "btn-login btn-login--connexion",
    on: {
      "click": _vm.checkUserStatus
    }
  }, [_c('span', {
    staticClass: "btn-login__text"
  }, [_vm._v(" " + _vm._s(_vm.messages.submit.first) + " ")]), _vm.waiting === 'wait' ? _c('svgWaiting') : _vm._e()], 1)])]);
};
var CheckStatusvue_type_template_id_0d56cd7c_staticRenderFns = [];

;// CONCATENATED MODULE: ./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/loaders/templateLoader.js??ruleSet[1].rules[3]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../drupal-vuejs/src/App/components/LoginGoogle.vue?vue&type=template&id=2d6edafd&
var LoginGooglevue_type_template_id_2d6edafd_render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c('div', {
    staticClass: "buttton-google-aouth",
    class: _vm.classRender,
    attrs: {
      "id": _vm.idHtmlrender,
      "client_google_is_define": _vm.client_google_is_define
    }
  });
};
var LoginGooglevue_type_template_id_2d6edafd_staticRenderFns = [];

;// CONCATENATED MODULE: ../drupal-vuejs/src/App/rx/google.js
//const gapi = window.gapi;
/* harmony default export */ var google = ({
  userAccess: {},
  //contient les informations renvoyés par google apres approbations.
  client_id: "513247959752-qapd9jb30pdtoh51m0h53070a2v8c4er.apps.googleusercontent.com"
});
// EXTERNAL MODULE: ../drupal-vuejs/node_modules/vuex/dist/vuex.esm.js
var vuex_esm = __webpack_require__(37662);
;// CONCATENATED MODULE: ./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../drupal-vuejs/src/App/components/LoginGoogle.vue?vue&type=script&lang=js&
function loadScript(src) {
  return new Promise(resolv => {
    var s = document.createElement("script");
    s.setAttribute("src", src);
    s.onload = function () {
      console.log(" Chargement du script ok : ", src);
      resolv(true);
    };
    document.head.appendChild(s);
  });
}




/* harmony default export */ var LoginGooglevue_type_script_lang_js_ = ({
  name: "LoginGoogle",
  props: {
    idHtml: {
      type: String,
      required: true
    },
    returnUidInfo: {
      type: Boolean,
      default: false
    },
    classRender: {
      type: Array,
      default: function () {
        return ["mx-auto"];
      }
    },
    actionAfterLogin: {
      type: String,
      required: true
    }
  },
  computed: {
    ...(0,vuex_esm/* mapState */.rn)(["configs_login_rx_vuejs"]),
    idHtmlrender() {
      return "google-login-tab" + this.idHtml;
    },
    client_google_is_define() {
      if (this.configs_login_rx_vuejs && this.configs_login_rx_vuejs.client_google_id) {
        this.initGoogle();
        return true;
      } else return "";
    }
  },
  methods: {
    initGoogle() {
      if (!window.google) {
        loadScript("https://accounts.google.com/gsi/client").then(() => {
          this.getUserInfoFromFrame();
        });
      } else {
        this.getUserInfoFromFrame();
      }
    },
    getUserInfoFromFrame() {
      var self = this;
      function handleCredentialResponse(response) {
        console.log("Encoded JWT ID token: ", response);
        google.userAccess = {
          ...response,
          client_id: response.clientId
        };
        self.TryToLoginWithGoogle();
        window.rxGoogle = google;
      }
      console.log(" window.onload ! ", window.onload);
      const goo = () => {
        window.google.accounts.id.initialize({
          client_id: this.configs_login_rx_vuejs.client_google_id,
          callback: handleCredentialResponse
        });
        window.google.accounts.id.renderButton(document.getElementById(self.idHtmlrender), {
          theme: "outline",
          size: "large"
        } // customization attributes
        );

        window.google.accounts.id.prompt(); // also display the One Tap dialog
      };

      goo();
    },
    /**
     * Ecoute un evenement afin de determiner si l'utilisateur a clique sur le bonton de connexion et que le processus soit terminé.
     */
    TryToLoginWithGoogle() {
      // this.IsBusy();
      // this.getFields();
      return new Promise((resolv, reject) => {
        utilities/* default.post */.Z.post("/login-rx-vuejs/google-check", google.userAccess).then(resp => {
          this.isBusy = false;
          this.alertDisplay = true;
          this.alertType = "alert-success";
          this.alertText = "Connexion réussie";
          this.$emit("ev_logingoogle", resp.data);
          // Si on souhaite juste obtenir les infos concernant l'utilisateur.
          if (this.returnUidInfo) {
            resolv(resp);
            return;
          }
          config_for_all.AfterRedirect(this.actionAfterLogin, null, resp);
          resolv(resp);
        }).catch(errors => {
          this.isBusy = false;
          this.alertDisplay = true;
          this.alertType = "alert-danger";
          this.alertText = "Google : Erreur de connexion";
          if (errors.error && errors.error.statusText && errors.error.statusText != "") {
            this.alertText = errors.error.statusText;
          }
          console.log(" Error ajax ", errors.error);
          console.log(" Error ajax ", errors.code);
          console.log(" Error ajax ", errors.stack);
          reject(errors);
        });
      });
    }
  }
});
;// CONCATENATED MODULE: ../drupal-vuejs/src/App/components/LoginGoogle.vue?vue&type=script&lang=js&
 /* harmony default export */ var components_LoginGooglevue_type_script_lang_js_ = (LoginGooglevue_type_script_lang_js_); 
;// CONCATENATED MODULE: ./node_modules/mini-css-extract-plugin/dist/loader.js??clonedRuleSet-22.use[0]!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-22.use[1]!./node_modules/@vue/vue-loader-v15/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-22.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-22.use[3]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../drupal-vuejs/src/App/components/LoginGoogle.vue?vue&type=style&index=0&id=2d6edafd&prod&lang=scss&
// extracted by mini-css-extract-plugin

;// CONCATENATED MODULE: ../drupal-vuejs/src/App/components/LoginGoogle.vue?vue&type=style&index=0&id=2d6edafd&prod&lang=scss&

// EXTERNAL MODULE: ./node_modules/@vue/vue-loader-v15/lib/runtime/componentNormalizer.js
var componentNormalizer = __webpack_require__(1001);
;// CONCATENATED MODULE: ../drupal-vuejs/src/App/components/LoginGoogle.vue



;


/* normalize component */

var component = (0,componentNormalizer/* default */.Z)(
  components_LoginGooglevue_type_script_lang_js_,
  LoginGooglevue_type_template_id_2d6edafd_render,
  LoginGooglevue_type_template_id_2d6edafd_staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* harmony default export */ var LoginGoogle = (component.exports);
;// CONCATENATED MODULE: ./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../drupal-vuejs/src/App/components/CheckStatus.vue?vue&type=script&lang=js&





/* harmony default export */ var CheckStatusvue_type_script_lang_js_ = ({
  name: "CheckStatus",
  components: {
    svgWaiting: () => __webpack_require__.e(/* import() */ 495).then(__webpack_require__.bind(__webpack_require__, 7495)),
    logingoogle: LoginGoogle
  },
  props: {
    urlLogo: {
      type: String,
      required: true
    },
    formValidate: {
      type: Object,
      required: true
    },
    actionAfterLogin: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      messages: config.messages,
      waiting: ""
    };
  },
  computed: {
    ...(0,vuex_esm/* mapState */.rn)(["form"])
  },
  methods: {
    loginFacebook() {
      this.waiting = "facebook";
      facebook.openPopup();
    },
    logOutFacebook() {
      facebook.logOut();
    },
    /**
     * Verifie si l'utilisateur existe deja.
     */
    async checkUserStatus() {
      this.waiting = "wait";
      var url = "/login-rx-vuejs/check-user-status";
      const test = await this.formValidate.validate();
      if (test) utilities/* default.post */.Z.post(url, this.form).then(resp => {
        this.waiting = "";
        if (resp.data) this.$emit("select-stepe", "setPassword");else {
          this.$emit("select-stepe", "register");
        }
      });else this.waiting = "";
    }
  }
});
;// CONCATENATED MODULE: ../drupal-vuejs/src/App/components/CheckStatus.vue?vue&type=script&lang=js&
 /* harmony default export */ var components_CheckStatusvue_type_script_lang_js_ = (CheckStatusvue_type_script_lang_js_); 
;// CONCATENATED MODULE: ../drupal-vuejs/src/App/components/CheckStatus.vue





/* normalize component */
;
var CheckStatus_component = (0,componentNormalizer/* default */.Z)(
  components_CheckStatusvue_type_script_lang_js_,
  CheckStatusvue_type_template_id_0d56cd7c_render,
  CheckStatusvue_type_template_id_0d56cd7c_staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* harmony default export */ var CheckStatus = (CheckStatus_component.exports);
;// CONCATENATED MODULE: ./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/loaders/templateLoader.js??ruleSet[1].rules[3]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../drupal-vuejs/src/App/components/SetPassword.vue?vue&type=template&id=ab2c4b2c&
var SetPasswordvue_type_template_id_ab2c4b2c_render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c('div', {
    staticClass: "content-center"
  }, [_c('a', {
    staticClass: "content-center__img",
    attrs: {
      "href": "/"
    }
  }, [_c('img', {
    attrs: {
      "src": _vm.urlLogo,
      "alt": ""
    }
  })]), _c('h3', {
    staticClass: "content-center__title"
  }, [_vm._v(_vm._s(_vm.messages.pass))]), _c('div', {
    staticClass: "form-group content-center__input"
  }, [_c('ValidationProvider', {
    ref: "refPass",
    attrs: {
      "name": "pass",
      "rules": "required"
    },
    scopedSlots: _vm._u([{
      key: "default",
      fn: function (v) {
        return [_vm.form.pass ? _c('input', {
          directives: [{
            name: "model",
            rawName: "v-model",
            value: _vm.form.pass[0].value,
            expression: "form.pass[0].value"
          }],
          staticClass: "form-control",
          attrs: {
            "type": "password",
            "name": "pass"
          },
          domProps: {
            "value": _vm.form.pass[0].value
          },
          on: {
            "input": function ($event) {
              if ($event.target.composing) return;
              _vm.$set(_vm.form.pass[0], "value", $event.target.value);
            }
          }
        }) : _vm._e(), _c('div', {
          staticClass: "text-danger text-small"
        }, _vm._l(v.errors, function (error, ii) {
          return _c('small', {
            key: ii,
            staticClass: "d-block"
          }, [_vm._v(" " + _vm._s(error) + " ")]);
        }), 0)];
      }
    }])
  })], 1), _c('a', {
    staticClass: "content-center__forgot-pass",
    attrs: {
      "href": "/user/password"
    }
  }, [_vm._v(" Mot de passe oublié ? ")]), _c('div', {
    staticClass: "content-center__btn"
  }, [_c('div', {
    staticClass: "btn-login btn-login--connexion",
    on: {
      "click": _vm.Login
    }
  }, [_c('span', {
    staticClass: "btn-login__text"
  }, [_vm._v(" " + _vm._s(_vm.messages.submit.connect) + " ")]), _vm.waiting == 'wait' ? _c('svgWaiting') : _vm._e()], 1)]), _c('hr'), _c('a', {
    staticClass: "text-center d-block",
    attrs: {
      "href": "#"
    },
    on: {
      "click": function ($event) {
        return _vm.$emit('select-stepe', 'checkstatus');
      }
    }
  }, [_vm._v(" Retour ")])]);
};
var SetPasswordvue_type_template_id_ab2c4b2c_staticRenderFns = [];

;// CONCATENATED MODULE: ./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../drupal-vuejs/src/App/components/SetPassword.vue?vue&type=script&lang=js&


/* harmony default export */ var SetPasswordvue_type_script_lang_js_ = ({
  name: "SetPassword",
  components: {
    svgWaiting: () => __webpack_require__.e(/* import() */ 495).then(__webpack_require__.bind(__webpack_require__, 7495))
  },
  props: {
    urlLogo: {
      type: String,
      required: true
    },
    formValidate: {
      type: Object,
      required: true
    },
    actionAfterLogin: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      messages: config.messages,
      waiting: ""
    };
  },
  computed: {
    ...(0,vuex_esm/* mapState */.rn)(["form"])
  },
  mounted() {
    if (this.form.pass === undefined) {
      this.$set(this.form, "pass", [{
        value: ""
      }]);
    }
  },
  methods: {
    async Login() {
      this.waiting = "wait";
      const test = await this.formValidate.validate();
      setTimeout(() => {
        if (test) config.connexionUser(this.form, this.actionAfterLogin).then(() => {
          this.waiting = "";
        }).catch(e => {
          console.log("Login : ", e);
          this.$refs.refPass.setErrors([e.error.statusText]);
          this.waiting = "error";
        });else this.waiting = "";
      }, 3000);
    }
  }
});
;// CONCATENATED MODULE: ../drupal-vuejs/src/App/components/SetPassword.vue?vue&type=script&lang=js&
 /* harmony default export */ var components_SetPasswordvue_type_script_lang_js_ = (SetPasswordvue_type_script_lang_js_); 
;// CONCATENATED MODULE: ../drupal-vuejs/src/App/components/SetPassword.vue





/* normalize component */
;
var SetPassword_component = (0,componentNormalizer/* default */.Z)(
  components_SetPasswordvue_type_script_lang_js_,
  SetPasswordvue_type_template_id_ab2c4b2c_render,
  SetPasswordvue_type_template_id_ab2c4b2c_staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* harmony default export */ var SetPassword = (SetPassword_component.exports);
;// CONCATENATED MODULE: ./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/loaders/templateLoader.js??ruleSet[1].rules[3]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../drupal-vuejs/src/App/components/RegisTer.vue?vue&type=template&id=f644ecb2&
var RegisTervue_type_template_id_f644ecb2_render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c('div', {
    staticClass: "content-center"
  }, [_c('a', {
    staticClass: "content-center__img",
    attrs: {
      "href": "/"
    }
  }, [_c('img', {
    attrs: {
      "src": _vm.urlLogo,
      "alt": ""
    }
  })]), _vm.modelRegisterFormResult === 'default' ? _c('div', [_c('h3', {
    staticClass: "content-center__title"
  }, [_vm._v(_vm._s(_vm.messages.login))]), _c('div', {
    staticClass: "form-group content-center__input"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.form.name[0].value,
      expression: "form.name[0].value"
    }],
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "readonly": "true",
      "name": "name"
    },
    domProps: {
      "value": _vm.form.name[0].value
    },
    on: {
      "input": function ($event) {
        if ($event.target.composing) return;
        _vm.$set(_vm.form.name[0], "value", $event.target.value);
      }
    }
  })]), _vm.showPassword ? _c('h3', {
    staticClass: "content-center__title"
  }, [_vm._v(" " + _vm._s(_vm.messages.pass) + " ")]) : _vm._e(), _vm.showPassword ? _c('div', {
    staticClass: "form-group content-center__input"
  }, [_vm.form.pass ? _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.form.pass[0].value,
      expression: "form.pass[0].value"
    }],
    staticClass: "form-control",
    attrs: {
      "type": "password",
      "name": "pass"
    },
    domProps: {
      "value": _vm.form.pass[0].value
    },
    on: {
      "input": function ($event) {
        if ($event.target.composing) return;
        _vm.$set(_vm.form.pass[0], "value", $event.target.value);
      }
    }
  }) : _vm._e()]) : _vm._e(), _c('h3', {
    staticClass: "content-center__title"
  }, [_vm._v(_vm._s(_vm.messages.mail))]), _c('ValidationProvider', {
    ref: "mail",
    staticClass: "d-block w-100",
    attrs: {
      "name": "mail",
      "rules": "required"
    },
    scopedSlots: _vm._u([{
      key: "default",
      fn: function (v) {
        return [_c('div', {
          staticClass: "form-group content-center__input"
        }, [_c('input', {
          directives: [{
            name: "model",
            rawName: "v-model",
            value: _vm.form.mail[0].value,
            expression: "form.mail[0].value"
          }],
          staticClass: "form-control",
          attrs: {
            "type": "mail",
            "name": "mail"
          },
          domProps: {
            "value": _vm.form.mail[0].value
          },
          on: {
            "input": function ($event) {
              if ($event.target.composing) return;
              _vm.$set(_vm.form.mail[0], "value", $event.target.value);
            }
          }
        })]), _c('div', {
          staticClass: "text-danger text-small"
        }, _vm._l(v.errors, function (error, ii) {
          return _c('small', {
            key: ii,
            staticClass: "d-block"
          }, [_vm._v(" " + _vm._s(error) + " ")]);
        }), 0)];
      }
    }], null, false, 3187930093)
  }), _vm._l(_vm.templates, function (temp, i) {
    return _c('ValidationProvider', {
      key: i,
      ref: temp.ref,
      refInFor: true,
      staticClass: "d-block w-100",
      scopedSlots: _vm._u([{
        key: "default",
        fn: function (v) {
          return [_c(temp, {
            tag: "component"
          }), _c('div', {
            staticClass: "text-danger text-small"
          }, _vm._l(v.errors, function (error, ii) {
            return _c('small', {
              key: ii,
              staticClass: "d-block"
            }, [_vm._v(" " + _vm._s(error) + " ")]);
          }), 0)];
        }
      }], null, true)
    });
  }), _c('div', {
    staticClass: "content-center__btn"
  }, [_c('div', {
    staticClass: "btn-login btn-login--connexion",
    on: {
      "click": _vm.RegisterDefault
    }
  }, [_c('span', {
    staticClass: "btn-login__text"
  }, [_vm._v(" " + _vm._s(_vm.messages.submit.register) + " ")]), _vm.waiting == 'wait' ? _c('svgWaiting') : _vm._e()], 1)]), _c('hr')], 2) : _vm._e(), _vm.modelRegisterFormResult === 'generate_password' ? _c('div', [_c('h4', {
    staticClass: "title"
  }, [_vm._v("Creation automatique du compte")]), _c('p', {
    staticClass: "mb-4"
  }, [_vm._v(" Vos informations de connexion seront transferés à cette adresse. ")]), _vm.validEmail(_vm.form.name[0].value) ? _c('div', {
    staticClass: "mb-5"
  }, [_c('strong', [_vm._v(" " + _vm._s(_vm.form.name[0].value) + " ")]), _vm._v(" " + _vm._s(_vm.set_email()) + " ")]) : _vm._e(), !_vm.validEmail(_vm.form.name[0].value) ? _c('div', [_c('ValidationProvider', {
    ref: "mail",
    staticClass: "d-block w-100",
    attrs: {
      "name": "mail",
      "rules": "required"
    },
    scopedSlots: _vm._u([{
      key: "default",
      fn: function (v) {
        return [_c('div', {
          staticClass: "form-group content-center__input"
        }, [_c('input', {
          directives: [{
            name: "model",
            rawName: "v-model",
            value: _vm.form.mail[0].value,
            expression: "form.mail[0].value"
          }],
          staticClass: "form-control",
          attrs: {
            "type": "mail",
            "name": "mail"
          },
          domProps: {
            "value": _vm.form.mail[0].value
          },
          on: {
            "input": function ($event) {
              if ($event.target.composing) return;
              _vm.$set(_vm.form.mail[0], "value", $event.target.value);
            }
          }
        })]), _c('div', {
          staticClass: "text-danger text-small"
        }, _vm._l(v.errors, function (error, ii) {
          return _c('small', {
            key: ii,
            staticClass: "d-block"
          }, [_vm._v(" " + _vm._s(error) + " ")]);
        }), 0)];
      }
    }], null, false, 3187930093)
  })], 1) : _vm._e(), _c('div', {
    staticClass: "content-center__btn"
  }, [_c('div', {
    staticClass: "btn-login btn-login--connexion",
    on: {
      "click": _vm.generatePassword
    }
  }, [_c('span', {
    staticClass: "btn-login__text"
  }, [_vm._v(" " + _vm._s(_vm.messages.submit.register) + " ")]), _vm.waiting == 'wait' ? _c('svgWaiting') : _vm._e()], 1)])]) : _vm._e(), _c('b-alert', {
    attrs: {
      "dismissible": "",
      "variant": "danger",
      "fade": "",
      "show": _vm.error.message ? true : false
    },
    on: {
      "dismissed": function ($event) {
        _vm.error.message = false;
      }
    }
  }, [_vm._v(" " + _vm._s(_vm.error.message) + " ")]), _c('a', {
    staticClass: "text-center d-block",
    attrs: {
      "href": "#"
    },
    on: {
      "click": function ($event) {
        return _vm.$emit('select-stepe', 'checkstatus');
      }
    }
  }, [_vm._v(" Retour ")])], 1);
};
var RegisTervue_type_template_id_f644ecb2_staticRenderFns = [];

;// CONCATENATED MODULE: ../drupal-vuejs/src/App/formatFields/InputBootstrap.js

/* harmony default export */ var InputBootstrap = ({
  modelsFields: {},
  /**
   * La valeur par defaut peut etre definit via defaultValue, lors de la consctruction, ou definit dans <component.
   * On recupere les données via un emit @b-input au niveau du <component.
   * @param {} h
   * @param {*} field
   * @param {*} defaultValue
   * @returns
   */
  string(h, field, defaultValue = []) {
    if (defaultValue.length === 0) {
      defaultValue.push({
        value: ""
      });
    }
    const inputs = [];
    // Ajout du label
    inputs.push(h("label", {
      class: ["d-block", "content-center__title"]
    }, [field.label_value]));
    defaultValue.forEach(el => {
      inputs.push(h("input", {
        props: {
          type: "text",
          value: el.value,
          b_input: {
            type: Object,
            required: true
          }
        },
        on: {
          input: function (e) {
            if (e.target && e.target.value) el.value = e.target.value;
          }
        },
        class: ["form-control"]
      }));
    });
    // ajout de la description
    inputs.push(h("small", {
      class: ["text-muted"]
    }, [field.description]));
    const formG = h("div", {
      props: {},
      class: ["form-group", "content-center__input"]
    }, inputs);
    return formG;
  }
});
;// CONCATENATED MODULE: ../drupal-vuejs/src/App/formatFields/formatFieldsBootstrap.js



/**
 * Permet de formater les champs drupal avec les equivalence bootstrap vuejs.
 */
class formatField {
  constructor(entity, bundle) {
    this.entity = entity;
    this.bundle = bundle;
    // ---------
  }
  /**
   * Retoune les champs convertie en utilisant les composants bootstrap-vuejs.
   * @returns Array []
   */
  async format() {
    var fields = await this.getFields();
    return new Promise((resolv, reject) => {
      if (fields.data && fields.data.fields) {
        InputBootstrap.modelsFields = this.buildModel(fields.data.fields);
        const formatFields = [];
        for (const i in fields.data.fields) {
          formatFields.push({
            ref: i,
            props: {
              name: {
                type: String,
                default: fields.data.fields[i].name
              }
            },
            render(createElement) {
              var renderField = [];
              switch (fields.data.fields[i].type) {
                case "string":
                  renderField.push(InputBootstrap.string(createElement, fields.data.fields[i], InputBootstrap.modelsFields[i]));
                  break;
              }
              return createElement("div", renderField);
            }
          });
        }
        resolv({
          templates: formatFields,
          models: InputBootstrap.modelsFields
        });
      } else {
        reject("Aucune donnée disponible");
      }
    });
  }

  /**
   * Get fileds in drupal.
   * @returns
   */
  getFields() {
    var url = "/api/form-node/generate-form";
    if (this.entity === "user") {
      url = "/api/form-node/generate-user";
    }
    url += "/" + this.bundle;
    return utilities/* default.get */.Z.get(url);
  }
  /**
   * - Cet object permet de rendre les elements de l'object ecoutable.
   *   on creer tous les champs, puis on initialise InputBootstrap.modelsFields avec tous les champs.
   *   De cette facon vuejs peut ecouter les MAJ de champs.
   */
  buildModel(fields) {
    const models = {};
    for (const i in fields) {
      if (fields[i].type) models[i] = [];
    }
    return models;
  }
}
/* harmony default export */ var formatFieldsBootstrap = (formatField);
;// CONCATENATED MODULE: ./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../drupal-vuejs/src/App/components/RegisTer.vue?vue&type=script&lang=js&




/* harmony default export */ var RegisTervue_type_script_lang_js_ = ({
  name: "RegisTer",
  components: {
    svgWaiting: () => __webpack_require__.e(/* import() */ 495).then(__webpack_require__.bind(__webpack_require__, 7495))
  },
  props: {
    urlLogo: {
      type: String,
      required: true
    },
    formValidate: {
      type: Object,
      required: true
    },
    showPassword: {
      type: Boolean,
      default: false
    },
    actionAfterRegister: {
      type: String,
      required: true
    },
    modelRegisterForm: {
      type: [String, Boolean],
      required: true
    },
    showModalSuccess: {
      type: Boolean,
      required: true
    }
  },
  data() {
    return {
      messages: config.messages,
      waiting: "",
      templates: [],
      /**
       * Drupal >9.5 renvoit l'erreur dans {message}
       */
      error: {
        message: false
      }
    };
  },
  computed: {
    ...(0,vuex_esm/* mapState */.rn)(["form", "configs_login_rx_vuejs"]),
    /**
     * Resultat entre la config endur et celle en BD.
     */
    modelRegisterFormResult() {
      if (this.modelRegisterForm) {
        return this.modelRegisterForms;
      } else if (this.configs_login_rx_vuejs && this.configs_login_rx_vuejs.generate_user) {
        return "generate_password";
      } else {
        return "default";
      }
    }
  },
  mounted() {
    if (this.showPassword) {
      if (this.form.pass === undefined) {
        this.$set(this.form, "pass", [{
          value: ""
        }]);
      }
    } else if (this.form.pass) {
      delete this.form.pass;
    }
    this.getFields();
  },
  methods: {
    async generatePassword() {
      this.waiting = "wait";
      var url = "/login-rx-vuejs/genrate-password";
      const test = await this.formValidate.validate();
      if (test) {
        utilities/* default.post */.Z.post(url, this.form).then(resp => {
          console.log("resp : ", resp);
          this.waiting = "";
          config.AfterRedirect(this.actionAfterRegister, null, resp);
        }).catch(() => {
          this.waiting = "";
        });
      } else {
        this.waiting = "";
        console.log("echec de validation de mail");
      }
    },
    /**
     * --
     */
    async RegisterDefault() {
      this.waiting = "wait";
      var url = "/user/register?_format=json";
      const test = await this.formValidate.validate();
      if (test) utilities/* default.post */.Z.post(url, this.form).then(resp => {
        this.waiting = "";
        if (this.showModalSuccess) config.modalSuccess(config.msgCreate([this.messages.devis_create_user]), {
          title: "Votre compte a été crré",
          footerClass: "d-none",
          headerBgVariant: "success",
          headerTextVariant: "light"
        }).then(() => {
          config.AfterRedirect(this.actionAfterRegister, null, resp);
        });else config.AfterRedirect(this.actionAfterRegister, null, resp);
      }).catch(e => {
        this.waiting = "";
        console.log("catch : ", e);
        if (e.error.data && e.error.data.message) {
          this.error.message = e.error.data.message;
        }
        if (e.error && e.error.data && e.error.data.errors) {
          const errors = e.error.data.errors;
          // console.log(" this.$refs : ", this.$refs);
          errors.forEach(error => {
            const field = error.split(":");
            // console.log(" field : ", field);
            if (this.$refs[field[0]]) {
              if (this.$refs[field[0]][0]) {
                this.$refs[field[0]][0].setErrors([field[1]]);
              } else this.$refs[field[0]].setErrors([field[1]]);
            }
          });
        }
      });else this.waiting = "";
    },
    /**
     * --
     */
    getFields() {
      const fds = new formatFieldsBootstrap("user", "user");
      fds.format().then(resp => {
        this.templates = resp.templates;
        for (const fieldName in resp.models) {
          this.$set(this.form, fieldName, resp.models[fieldName]);
        }
        console.log("resp : ", resp);
      });
    },
    validEmail(email) {
      var re = /\S+@\S+\.\S+/;
      return re.test(email);
    },
    set_email() {
      this.form.mail = this.form.name;
    }
  }
});
;// CONCATENATED MODULE: ../drupal-vuejs/src/App/components/RegisTer.vue?vue&type=script&lang=js&
 /* harmony default export */ var components_RegisTervue_type_script_lang_js_ = (RegisTervue_type_script_lang_js_); 
;// CONCATENATED MODULE: ../drupal-vuejs/src/App/components/RegisTer.vue





/* normalize component */
;
var RegisTer_component = (0,componentNormalizer/* default */.Z)(
  components_RegisTervue_type_script_lang_js_,
  RegisTervue_type_template_id_f644ecb2_render,
  RegisTervue_type_template_id_f644ecb2_staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* harmony default export */ var RegisTer = (RegisTer_component.exports);
;// CONCATENATED MODULE: ./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../drupal-vuejs/src/App/components/LoginRegister.vue?vue&type=script&lang=js&




//import { ValidationObserver } from "vee-validate";






/* harmony default export */ var LoginRegistervue_type_script_lang_js_ = ({
  name: "LoginRegister",
  props: {
    // see config_for_all.AfterRedirect for more informations.
    actionAfterLogin: {
      type: String,
      default: "default"
    },
    // see config_for_all.AfterRedirect for more informations.
    actionAfterRegister: {
      type: String,
      default: "default"
    },
    modelRegisterForm: {
      type: [String, Boolean],
      default: false
    },
    showPassword: {
      type: Boolean,
      default: true
    },
    showModalSuccess: {
      type: Boolean,
      default: true
    }
  },
  /**
   * --
   */
  data() {
    return {
      messages: config.messages,
      waiting: "",
      stepe: CheckStatus,
      models: {},
      baseURl: src_config/* default.baseURl */.Z.baseURl,
      isBusy: false,
      alertDisplay: false,
      alertType: "alert-danger",
      alertText: "",
      urlLogo: window.location.origin + "" + window.logo_current_theme,
      formValidate: {}
    };
  },
  computed: {
    ...(0,vuex_esm/* mapState */.rn)(["configs_login_rx_vuejs"]),
    facebook_app_is_define() {
      if (this.configs_login_rx_vuejs && this.configs_login_rx_vuejs.facebook_app_id) {
        this.initFacebook();
        return true;
      } else return "";
    }
  },
  /**
   * --
   */
  mounted() {
    this.formValidate = this.$refs.formValidate;
    this.getConfigs();
  },
  methods: {
    initFacebook() {
      facebook.appId = this.configs_login_rx_vuejs.facebook_app_id; //889256191665205;
      this.TryToLoginWithFacebook();
      facebook.chargement();
    },
    selectStepe(step) {
      switch (step) {
        case "checkstatus":
          this.stepe = CheckStatus;
          break;
        case "setPassword":
          this.stepe = SetPassword;
          break;
        case "register":
          this.stepe = RegisTer;
          break;
      }
    },
    /**
     * Ecoute un evenement afin de determiner si l'utilisateur a clique sur le bonton de connexion et que le processus soit terminé.
     */
    TryToLoginWithFacebook() {
      document.addEventListener("wbu-fb-status-change", () => {
        this.isBusy = true;
        this.getFields();
        utilities/* default.post */.Z.post("/login-rx-vuejs/facebook-check", facebook.user).then(resp => {
          this.isBusy = false;
          this.alertDisplay = true;
          this.alertType = "alert-success";
          this.alertText = " Connexion réussie  ";
          if (resp.reponse && resp.reponse.config.url !== resp.reponse.request.responseURL) {
            window.location.assign(resp.reponse.request.responseURL);
          }
          // il faut s'assurer que les données sont ok.
          else if (resp.data && resp.data.createuser) {
            this.stepe = "final-fb-register";
          } else {
            window.location.assign(window.location.origin);
          }
        }).catch(errors => {
          this.isBusy = false;
          this.isBusy = false;
          this.alertDisplay = true;
          this.alertType = "alert-danger";
          this.alertText = "Facebook : Erreur de connexion ";
          if (errors.error) {
            this.alertText = errors.error.statusText;
          }
        });
      }, false);
    },
    IsBusy() {
      this.isBusy = true;
      console.log("this.isbusy", this.isBusy);
    },
    /**
     * --
     */
    async finalRegister() {
      this.waiting = "wait";
      var params = {};
      var url = "";
      if (this.stepe === "final-gl-register") {
        url = "/login-rx-vuejs/google-login";
        params = {
          fields: this.models,
          google: []
        };
      } else if (this.stepe === "final-fb-register") {
        url = "/login-rx-vuejs/facebook-login";
        params = {
          fields: this.models,
          facebook: facebook.user
        };
      }
      const test = await this.$refs.formValidate.validate();
      if (test) utilities/* default.post */.Z.post(url, params).then(resp => {
        console.log(resp);
        this.waiting = "";
        if (resp.reponse && resp.reponse.config.url !== resp.reponse.request.responseURL) {
          window.location.assign(resp.reponse.request.responseURL);
        }
      });
    },
    /**
     * Helper to login user.
     * ( This function is used by modules that create accounts and then need to login the user. )
     * @param {*} form
     */
    connexionUser(form) {
      return config.connexionUser(form, this.actionAfterLogin);
    },
    getConfigs() {
      var url = "/login-rx-vuejs/get-configs";
      utilities/* default.post */.Z.post(url, this.form).then(resp => {
        this.$store.state.configs_login_rx_vuejs = resp.data;
      }).catch(e => {
        console.log(e);
      });
    }
  }
});
;// CONCATENATED MODULE: ../drupal-vuejs/src/App/components/LoginRegister.vue?vue&type=script&lang=js&
 /* harmony default export */ var components_LoginRegistervue_type_script_lang_js_ = (LoginRegistervue_type_script_lang_js_); 
;// CONCATENATED MODULE: ./node_modules/mini-css-extract-plugin/dist/loader.js??clonedRuleSet-22.use[0]!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-22.use[1]!./node_modules/@vue/vue-loader-v15/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-22.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-22.use[3]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../drupal-vuejs/src/App/components/LoginRegister.vue?vue&type=style&index=0&id=77b94591&prod&lang=scss&
// extracted by mini-css-extract-plugin

;// CONCATENATED MODULE: ../drupal-vuejs/src/App/components/LoginRegister.vue?vue&type=style&index=0&id=77b94591&prod&lang=scss&

;// CONCATENATED MODULE: ../drupal-vuejs/src/App/components/LoginRegister.vue



;


/* normalize component */

var LoginRegister_component = (0,componentNormalizer/* default */.Z)(
  components_LoginRegistervue_type_script_lang_js_,
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* harmony default export */ var LoginRegister = (LoginRegister_component.exports);

/***/ })

}]);
//# sourceMappingURL=bookingSystem.common.961.js.map