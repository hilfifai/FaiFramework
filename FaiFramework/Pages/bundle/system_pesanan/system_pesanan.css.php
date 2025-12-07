<style>
              p {
            margin: 0;
          }
          .page {
            width: 370px;
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 10px 10px 4px #e1e4e9;
          }
          .timeline {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
           /* gap: 10px;*/
            align-items: center;
            padding-bottom: 20px;
            justify-content: center;
          }
          .line {
            width: 70px;
            height: 2px;
            background-color: #eaedf1;
            margin-bottom: 15px;
          }
          .background {
            background-color: #6156e3;
            width: 30px;
            height: 30px;
            display: grid;
            place-items: center;
            border-radius: 5px;
            padding: 7px;
            float:inline-start;
          }
          .white {
            background-color: white;
            border: 1px solid #e2e7eb;
          }
          .sub-text {
            padding-top: 0px;
            font-size: 10px;
            font-weight: 700;
          }
          .gray {
            color: #a8b3c0;
          }
          .message {
            font-size: 10px;
            background-color: #fff6df;
            display: flex;
            align-items: center;
            padding: 5px;
          }
          .message-text {
            padding-left: 10px;
            color: #beb190;
          }
          .message-text span {
            color: #8f7a4a;
          }
          .heading {
            font-size: 14px;
            padding: 10px 0;
            font-weight: 700;
          }
          .item-list {
            display: grid;
            grid-template-rows: 1fr 1fr;
            gap: 10px;
          }
          .item {
            display: grid;
            grid-template-columns: 2fr 5fr 1fr;
            align-items: center;
            gap: 10px;
            border: 2px solid #f2f5f9;
            padding: 10px;
            border-radius: 5px;
          }
          .vintage-image {
            width: 70px;
            height: 70px;
          }
          .item-name {
            font-size: 11px;
            font-weight: 500;
          }
          .item-seller {
            padding-top: 3px;
            padding-bottom: 6.5px;
            color: #c1c5cb;
            font-size: 9.5px;
          }
          .item-seller span {
            color: black;
          }
          .stock-left {
            color: #e97171;
            font-size: 8.5px;
            font-weight: 500;
          }
          .options {
            padding-top: 11px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            color: #96a4ae;
            font-size: 7.5px;
            font-weight: bold;
          }
          .buy-later {
            color: #7c74e8;
          }
          .dollar {
            font-size: 13px;
            color: #949eab;
          }
          .dollar span {
            vertical-align: text-top;
            font-size: 16px;
            color: black;
          }
          .discount {
            padding-top: 5px;
            padding-bottom: 11.5px;
            color: #867eeb;
            font-size: 8.5px;
            font-weight: bold;
          }
          .order-quantity {
            border: 2px solid #f2f5f9;
            padding: 3px;
            font-size: 7px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            align-items: center;
            justify-content: center;
            color: #a0a0a0;
          }
          .payment-option {
            border: 2px solid #f2f5f9;
            border-radius: 5px;
            padding: 10px;
            display: grid;
            grid-template-columns: 3fr 9fr 1.5fr;
            align-items: center;
            margin-bottom: 10px;
          }
          .bank {
            background-color: #4c40e0;
            padding: 7.5px 15px;
            border-radius: 5px;
          }
          .bank-information {
            font-size: 12px;
          }
          .bank-information p {
            color: #c5cdd3;
            font-size: 10px;
          }
          button {
            background-color: #4c40e0;
            color: white;
            border-style: none;
            width: 100%;
            height: 40px;
            border-radius: 5px;
            padding: 10px;
            font-size: 10px;
            font-weight: bold;
          }
          * {
            font-family: "Work Sans", sans-serif;
            font-size: 16px;
          }
          .__referral .tabpanel-head {
            background: none;
            border: none;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            opacity: 1;
            margin-bottom: 10px;
          }
          .__referral .tabpanel-tab {
            background: #fef1f9;
            border: none;
            outline: 1px solid transparent;
            color: #f2008d;
            font-size: 18px;
            font-weight: 600;
            padding: 18px 0;
            text-align: center;
            text-transform: none;
            display: inline-flex;
            justify-content: center;
          }
          .__referral .tabpanel-tab span {
            display: none;
            padding-left: 5px;
          }
          .__referral .tabpanel-tab:hover {
            color: #470030;
            background: #eee;
          }
          .__referral .tabpanel-tab.__active {
            background: none;
            border: none;
            color: #c20072;
          }
          .__referral .tabpanel-tab.__complete span {
            display: block;
          }
          .__referral .tabpanel-tab:hover, .__referral .tabpanel-tab:focus, .__referral .tabpanel-tab:active {
            background: none;
            text-decoration: none;
          }
          .__referral .tabpanel-panel {
            padding: 20px;
            color: #470030;
            display: none;
          }
          .__referral .tabpanel-panel.__active {
            display: block;
          }
          .__referral .tabpanel-content {
            border: 1px solid #eee;
            border-top: transparent;
          }
          .__referral .tabpanel-title {
            font-size: 24px;
            margin: 10px 0;
          }
          .__referral .tabpanel-progress-bar {
            background-color: #f449ad;
            border-radius: 4px;
            height: 9px;
            width: 0;
          }
          .__referral .tabpanel-progress-bar-wrap {
            background-color: #f8e8f2;
            border-radius: 4px;
          }
          .__referral .tabpanel-content {
            border: none;
          }
          .tab-pane {
            display: none;
          }
          .tab-pane.__active {
            display: block;
          }
          .button {
            background-color: #c20072;
            border: none;
            box-shadow: none;
            color: #ffffff;
            border-radius: 4px;
            padding: 10px 20px;
          }

      </style>