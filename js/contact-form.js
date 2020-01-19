(function(root, factory) {
  "use strict";
  if (typeof define === "function" && define.amd) {
    define([], factory);
  } else if (typeof exports === "object") {
    module.exports = factory();
  } else {
    root.ContactForm = factory();
  }
})(this, function() {
  "use strict";

  let ContactForm = function(form, options) {
    if (!this || !(this instanceof ContactForm)) {
      return new ContactForm(form, options);
    }

    if (!form || !options) {
      return;
    }

    this.form = form instanceof Node ? form : document.querySelector(form);
    this.endpoint = options.endpoint;

    this.send();
  };

  ContactForm.prototype = {
    hasClass: function(el, name) {
      return new RegExp("(\\s|^)" + name + "(\\s|$)").test(el.className);
    },
    addClass: function(el, name) {
      if (!this.hasClass(el, name)) {
        el.className += (el.className ? " " : "") + name;
      }
    },
    removeClass: function(el, name) {
      if (this.hasClass(el, name)) {
        el.className = el.className
          .replace(new RegExp("(\\s|^)" + name + "(\\s|$)"), " ")
          .replace(/^\s+|\s+$/g, "");
      }
    },
    each: function(collection, iterator) {
      let i, len;

      for (i = 0, len = collection.length; i < len; i += 1) {
        iterator(collection[i], i, collection);
      }
    },
    template: function(string, data) {
      let piece;

      for (piece in data) {
        if (Object.prototype.hasOwnProperty.call(data, piece)) {
          string = string.replace(
            new RegExp("{" + piece + "}", "g"),
            data[piece]
          );
        }
      }

      return string;
    },
    empty: function(el) {
      while (el.firstChild) {
        el.removeChild(el.firstChild);
      }
    },
    removeElementsByClass: function(className) {
      let elements = document.getElementsByClassName(className);

      while (elements.length > 0) {
        elements[0].parentNode.removeChild(elements[0]);
      }
    },
    post: function(path, data, success, fail) {
      let xhttp = new XMLHttpRequest();

      xhttp.open("POST", path, true);
      xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
      xhttp.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded; charset=UTF-8"
      );
      xhttp.onreadystatechange = function() {
        if (this.readyState === 4) {
          if (this.status === 200) {
            let response = "";
            try {
              response = JSON.parse(this.responseText);
            } catch (err) {
              response = this.responseText;
            }
            success.call(this, response);
          } else {
            fail.call(this, this.responseText);
          }
        }
      };
      xhttp.send(data);
      xhttp = null;
    },
    param: function(data) {
      let params =
        typeof data === "string"
          ? data
          : Object.keys(data)
              .map(function(k) {
                return (
                  encodeURIComponent(k) + "=" + encodeURIComponent(data[k])
                );
              })
              .join("&");

      return params;
    },
    send: function() {
      this.form.addEventListener(
        "submit",
        function(e) {
          e.preventDefault();

          let elements = document.querySelectorAll(".form-control"),
            formData;

          this.each(
            elements,
            function(el, i) {
              if (this.hasClass(el.parentNode, "has-error")) {
                this.removeClass(el.parentNode, "has-error");
                this.removeElementsByClass("help-block");
              }
            }.bind(this)
          );

          formData = {
            name: document.querySelector('input[name="form-name"]').value,
            email: document.querySelector('input[name="form-email"]').value,
            subject: document.querySelector('input[name="form-subject"]').value,
            message: document.querySelector('textarea[name="form-message"]')
              .value
          };

          this.post(
            this.endpoint,
            this.param(formData),
            this.feedback.bind(this),
            this.fail.bind(this)
          );
        }.bind(this),
        false
      );
    },
    feedback: function(data) {
      if (!data.success) {
        if (data.errors.name) {
          let name = document.querySelector('input[name="form-name"]')
              .parentNode,
            error;

          this.addClass(name, "has-error");
          error = this.template('<span class="help-block">{report}</span>', {
            report: data.errors.name
          });

          name.insertAdjacentHTML("beforeend", error);
        }

        if (data.errors.email) {
          let email = document.querySelector('input[name="form-email"]')
              .parentNode,
            error;

          this.addClass(email, "has-error");
          error = this.template('<span class="help-block">{report}</span>', {
            report: data.errors.email
          });

          email.insertAdjacentHTML("beforeend", error);
        }

        if (data.errors.subject) {
          let subject = document.querySelector('input[name="form-subject"]')
              .parentNode,
            error;

          this.addClass(subject, "has-error");
          error = this.template('<span class="help-block">{report}</span>', {
            report: data.errors.subject
          });

          subject.insertAdjacentHTML("beforeend", error);
        }

        if (data.errors.message) {
          let message = document.querySelector('textarea[name="form-message"]')
              .parentNode,
            error;

          this.addClass(message, "has-error");
          error = this.template('<span class="help-block">{report}</span>', {
            report: data.errors.message
          });

          message.insertAdjacentHTML("beforeend", error);
        }
      } else {
        let success = this.template(
          '<div class="alert-success">{report}</div>',
          {
            report: data.message
          }
        );

        this.empty(this.form);
        this.form.insertAdjacentHTML("beforeend", success);
      }
    },
    fail: function(data) {
      console.log(data);
    }
  };

  return ContactForm;
});
new ContactForm("#contact-form", {
  endpoint: "/wp-content/themes/jms/cf/process.php"
});
