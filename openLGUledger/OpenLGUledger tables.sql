--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: openLGUledger; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE "openLGUledger" IS 'Final';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: audit_trail; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE audit_trail (
    audit_trail_id integer NOT NULL,
    date date NOT NULL,
    amount_involved numeric DEFAULT 0 NOT NULL,
    activity text NOT NULL,
    "user" text NOT NULL
);


ALTER TABLE public.audit_trail OWNER TO postgres;

--
-- Name: audit_trail_audit_trail_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE audit_trail_audit_trail_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.audit_trail_audit_trail_id_seq OWNER TO postgres;

--
-- Name: audit_trail_audit_trail_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE audit_trail_audit_trail_id_seq OWNED BY audit_trail.audit_trail_id;


--
-- Name: date_generated; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE date_generated (
    date_generated_id integer NOT NULL,
    date_generated_value date
);


ALTER TABLE public.date_generated OWNER TO postgres;

--
-- Name: journal_entry; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE journal_entry (
    journal_id integer NOT NULL,
    journal_page integer NOT NULL,
    transaction_number integer,
    date date NOT NULL,
    responsibility_center text,
    total_debit numeric DEFAULT 0 NOT NULL,
    total_credit numeric DEFAULT 0 NOT NULL,
    comment text,
    entry_type text,
    post_status integer DEFAULT 0
);


ALTER TABLE public.journal_entry OWNER TO postgres;

--
-- Name: journal_entry_journal_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE journal_entry_journal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.journal_entry_journal_id_seq OWNER TO postgres;

--
-- Name: journal_entry_journal_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE journal_entry_journal_id_seq OWNED BY journal_entry.journal_id;


--
-- Name: ledger; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ledger (
    account_code integer NOT NULL,
    account_title text NOT NULL,
    ledger_page integer NOT NULL,
    major_account_title text,
    normal_balance text,
    debit numeric DEFAULT 0 NOT NULL,
    credit numeric DEFAULT 0 NOT NULL
);


ALTER TABLE public.ledger OWNER TO postgres;

--
-- Name: ledger_entries; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ledger_entries (
    ledger_entry_id integer NOT NULL,
    particular_id integer NOT NULL,
    date date NOT NULL,
    account_title text NOT NULL,
    account_code integer NOT NULL,
    journal_page integer NOT NULL,
    ledger_page integer NOT NULL,
    debit numeric DEFAULT 0 NOT NULL,
    credit numeric DEFAULT 0 NOT NULL
);


ALTER TABLE public.ledger_entries OWNER TO postgres;

--
-- Name: ledger_entries_ledger_entry_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ledger_entries_ledger_entry_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ledger_entries_ledger_entry_id_seq OWNER TO postgres;

--
-- Name: ledger_entries_ledger_entry_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ledger_entries_ledger_entry_id_seq OWNED BY ledger_entries.ledger_entry_id;


--
-- Name: log; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE log (
    log_id integer NOT NULL,
    journal_page integer,
    comment text
);


ALTER TABLE public.log OWNER TO postgres;

--
-- Name: log_log_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE log_log_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.log_log_id_seq OWNER TO postgres;

--
-- Name: log_log_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE log_log_id_seq OWNED BY log.log_id;


--
-- Name: particulars; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE particulars (
    particular_id integer NOT NULL,
    journal_id integer,
    date date,
    journal_page integer,
    ledger_page integer NOT NULL,
    account_title text NOT NULL,
    account_code integer NOT NULL,
    pr text,
    debit numeric NOT NULL,
    credit numeric NOT NULL
);


ALTER TABLE public.particulars OWNER TO postgres;

--
-- Name: particulars_particular_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE particulars_particular_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.particulars_particular_id_seq OWNER TO postgres;

--
-- Name: particulars_particular_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE particulars_particular_id_seq OWNED BY particulars.particular_id;


--
-- Name: posted_journal_entry; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE posted_journal_entry (
    posted_entry integer NOT NULL,
    journal_page integer,
    transaction_number integer,
    date date,
    year integer,
    month text,
    day integer,
    responsibility_center text,
    total_debit numeric,
    total_credit numeric,
    comment text,
    entry_type text
);


ALTER TABLE public.posted_journal_entry OWNER TO postgres;

--
-- Name: posted_journal_entry_posted_entry_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE posted_journal_entry_posted_entry_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.posted_journal_entry_posted_entry_seq OWNER TO postgres;

--
-- Name: posted_journal_entry_posted_entry_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE posted_journal_entry_posted_entry_seq OWNED BY posted_journal_entry.posted_entry;


--
-- Name: status_holder; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE status_holder (
    status_holder_id integer NOT NULL,
    last_month_status integer,
    today_month_status integer,
    accept_status integer,
    date_holder date,
    constant_id integer
);


ALTER TABLE public.status_holder OWNER TO postgres;

--
-- Name: status_holder_status_holder_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE status_holder_status_holder_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.status_holder_status_holder_id_seq OWNER TO postgres;

--
-- Name: status_holder_status_holder_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE status_holder_status_holder_id_seq OWNED BY status_holder.status_holder_id;


--
-- Name: transaction_number; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE transaction_number (
    transaction_number_id integer NOT NULL,
    transaction_number_value integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.transaction_number OWNER TO postgres;

--
-- Name: transaction_number_transaction_number_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE transaction_number_transaction_number_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.transaction_number_transaction_number_id_seq OWNER TO postgres;

--
-- Name: transaction_number_transaction_number_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE transaction_number_transaction_number_id_seq OWNED BY transaction_number.transaction_number_id;


--
-- Name: trial_balance; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE trial_balance (
    trial_balance_id integer NOT NULL,
    account_title text,
    account_code integer,
    debit_balance numeric DEFAULT 0,
    credit_balance numeric DEFAULT 0
);


ALTER TABLE public.trial_balance OWNER TO postgres;

--
-- Name: trial_balance_date; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE trial_balance_date (
    trial_balance_date_id integer NOT NULL,
    asof date
);


ALTER TABLE public.trial_balance_date OWNER TO postgres;

--
-- Name: trial_balance_date_trial_balance_asof_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE trial_balance_date_trial_balance_asof_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.trial_balance_date_trial_balance_asof_id_seq OWNER TO postgres;

--
-- Name: trial_balance_date_trial_balance_asof_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE trial_balance_date_trial_balance_asof_id_seq OWNED BY trial_balance_date.trial_balance_date_id;


--
-- Name: trial_balance_trial_balance_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE trial_balance_trial_balance_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.trial_balance_trial_balance_id_seq OWNER TO postgres;

--
-- Name: trial_balance_trial_balance_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE trial_balance_trial_balance_id_seq OWNED BY trial_balance.trial_balance_id;


--
-- Name: trial_monthly; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE trial_monthly (
    trial_balance_id integer NOT NULL,
    account_title text,
    account_code integer,
    debit_balance numeric DEFAULT 0,
    credit_balance numeric DEFAULT 0
);


ALTER TABLE public.trial_monthly OWNER TO postgres;

--
-- Name: trial_monthly_trial_balance_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE trial_monthly_trial_balance_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.trial_monthly_trial_balance_id_seq OWNER TO postgres;

--
-- Name: trial_monthly_trial_balance_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE trial_monthly_trial_balance_id_seq OWNED BY trial_monthly.trial_balance_id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE users (
    user_id integer NOT NULL,
    first_name text NOT NULL,
    last_name text NOT NULL,
    email text,
    username text NOT NULL,
    password text NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE users_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_user_id_seq OWNER TO postgres;

--
-- Name: users_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_user_id_seq OWNED BY users.user_id;


--
-- Name: audit_trail_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY audit_trail ALTER COLUMN audit_trail_id SET DEFAULT nextval('audit_trail_audit_trail_id_seq'::regclass);


--
-- Name: journal_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY journal_entry ALTER COLUMN journal_id SET DEFAULT nextval('journal_entry_journal_id_seq'::regclass);


--
-- Name: ledger_entry_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ledger_entries ALTER COLUMN ledger_entry_id SET DEFAULT nextval('ledger_entries_ledger_entry_id_seq'::regclass);


--
-- Name: log_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY log ALTER COLUMN log_id SET DEFAULT nextval('log_log_id_seq'::regclass);


--
-- Name: particular_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY particulars ALTER COLUMN particular_id SET DEFAULT nextval('particulars_particular_id_seq'::regclass);


--
-- Name: posted_entry; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY posted_journal_entry ALTER COLUMN posted_entry SET DEFAULT nextval('posted_journal_entry_posted_entry_seq'::regclass);


--
-- Name: status_holder_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY status_holder ALTER COLUMN status_holder_id SET DEFAULT nextval('status_holder_status_holder_id_seq'::regclass);


--
-- Name: transaction_number_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY transaction_number ALTER COLUMN transaction_number_id SET DEFAULT nextval('transaction_number_transaction_number_id_seq'::regclass);


--
-- Name: trial_balance_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY trial_balance ALTER COLUMN trial_balance_id SET DEFAULT nextval('trial_balance_trial_balance_id_seq'::regclass);


--
-- Name: trial_balance_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY trial_monthly ALTER COLUMN trial_balance_id SET DEFAULT nextval('trial_monthly_trial_balance_id_seq'::regclass);


--
-- Name: user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN user_id SET DEFAULT nextval('users_user_id_seq'::regclass);


--
-- Data for Name: audit_trail; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: audit_trail_audit_trail_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('audit_trail_audit_trail_id_seq', 165, true);


--
-- Data for Name: date_generated; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO date_generated VALUES (1, '2014-12-02');


--
-- Data for Name: journal_entry; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: journal_entry_journal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('journal_entry_journal_id_seq', 40, true);


--
-- Data for Name: ledger; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO ledger VALUES (101, 'Cash in Vault', 1, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (102, 'Cash - Collecting Officers', 2, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (103, 'Cash - Disbursing Officers', 3, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (104, 'Petty Cash Fund', 4, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (106, 'Payroll Fund', 5, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (108, 'Cash - National Treasury, Modified Disbursement System (MDS)', 6, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (110, 'Cash - Bangko Sentral Ng Pilipinas', 7, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (111, 'Cash in Bank- Local Currency, Current Account', 8, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (112, 'Cash in Bank- Local Currency, Savings Account', 9, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (113, 'Cash in Bank- Local Currency, Time Deposits', 10, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (114, 'Cash - Bangko Sentral ng Pilipinas', 11, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (115, 'Cash in Bank - Foreign Currency, Current Account', 12, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (116, 'Cash in Bank - Foreign Currency, Savings Account', 13, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (117, 'Cash in Bank - Foreign Currency, Time Deposits', 14, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (121, 'Accounts Receivable', 15, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (301, 'Allowance for Doubtful Accounts', 16, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (122, 'Notes Receivable', 17, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (123, 'Due from Officers and Employees', 18, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (124, 'Loans Receivables - GOCCs', 19, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (125, 'Loans Receivables - LGUs', 20, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (126, 'Loans Receivables - Others', 21, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (127, 'Real Property Tax Receivables', 22, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (128, 'Special Education Tax Receivables', 23, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (129, 'Interest Receivable', 24, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (130, 'Currency Swap Receivable', 25, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (131, 'Due from National Treasury', 26, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (136, 'Due from NGAs', 27, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (137, 'Due from GOCCs', 28, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (138, 'Due from LGUs', 29, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (139, 'Due from NGOs/POs', 30, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (141, 'Due from Central Office/Home Office', 31, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (142, 'Due from Regional Offices/Staff Bureaus/Branch Offices', 32, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (143, 'Due from Operating Units', 33, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (144, 'Due from Other Funds', 34, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (145, 'Due from Subsidiaries/Affiliates', 35, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (146, 'Receivables - Disallowances/Charges', 36, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (147, 'Dividend Receivable', 37, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (148, 'Advances to Officers and Employees', 38, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (149, 'Other Receivables', 39, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (152, 'Work-in-Process Inventory', 40, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (153, 'Finished Goods Inventory', 41, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (156, 'Accountable Forms Inventory', 42, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (157, 'Animal/Zoological Supplies Inventory', 43, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (158, 'Food Supplies Inventory', 44, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (159, 'Drugs and Medicines Inventory', 45, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (160, 'Medical, Dental and Laboratory Supplies Inventory', 46, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (161, 'Gasoline, Oil and Lubricants Inventory', 47, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (162, 'Agricultural Supplies Inventory', 48, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (163, 'Textbooks and Instructional Materials Inventory', 49, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (164, 'Military and Police Supplies Inventory', 50, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (165, 'Other Supplies Inventory', 51, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (166, 'Confiscated/Abandoned/Seized Goods Inventory', 52, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (167, 'Spare Parts Inventory', 53, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (168, 'Construction Materials Inventory', 54, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (169, 'Livestock Inventory', 55, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (170, 'Crops and Fruits Inventory', 56, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (176, 'Other Agricultural, Fishery and Forestry Products Inventory', 57, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (177, 'Prepaid Rent', 58, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (178, 'Prepaid Insurance', 59, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (179, 'Prepaid Interest', 60, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (180, 'Deposit on Letters of Credit', 61, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (181, 'Advances to Contractors', 62, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (182, 'Deferred Charges', 63, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (183, 'Organization Cost', 64, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (185, 'Other Prepaid Expenses', 65, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (186, 'Guaranty Deposits', 66, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (189, 'Other Current Assets', 67, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (191, 'Investments in Treasury Bills', 68, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (192, 'Investments in Stocks', 69, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (193, 'Investments in Bonds', 70, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (197, 'Other Investments and Marketable Securities', 71, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (198, 'Sinking Fund', 72, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (201, 'Land', 73, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (202, 'Land Improvements', 74, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (302, 'Accumulated Depreciation - Land Improvements', 75, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (203, 'Runways/Taxiways', 76, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (303, 'Accumulated Depreciation - Runways/Taxiways', 77, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (204, 'Railways', 78, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (304, 'Accumulated Depreciation - Railways', 79, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (205, 'Electrification, Power and Energy Structures', 80, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (305, 'Accumulated Depreciation - Electrification, Power and Energy Structures', 81, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (311, 'Accumulated Depreciation - Office Buildings', 82, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (211, 'Office Buildings', 83, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (212, 'School Buildings', 84, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (312, 'Accumulated Depreciation - School Buildings', 85, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (213, 'Hospitals and Health Centers', 86, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (313, 'Accumulated Depreciation - Hospitals and Health Centers', 87, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (214, 'Markets and Slaughterhouses', 88, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (314, 'Accumulated Depreciation - Markets and Slaughterhouses', 89, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (215, 'Other Structures', 90, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (315, 'Accumulated Depreciation - Other Structures', 91, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (218, 'Leasehold Improvements, Land', 92, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (318, 'Accumulated Depreciation - Leasehold Improvements, Land', 93, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (219, 'Leasehold Improvements, Buildings', 94, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (319, 'Accumulated Depreciation- Leasehold Improvement, Buildings', 95, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (220, 'Other Leasehold Improvements', 96, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (320, 'Accumulated Depreciation - Other Leasehold Improvements', 97, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (221, 'Office Equipment', 98, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (321, 'Accumulated Depreciation - Office Equipment', 99, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (222, 'Furniture and Fixtures', 100, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (322, 'Accumulated Depreciation - Furniture and Fixtures', 101, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (223, 'IT Equipment and Software', 102, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (323, 'Accumulated Depreciation- IT Equipment and Technology', 103, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (224, 'Library Books', 104, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (324, 'Accumulated Depreciation - Library Books', 105, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (226, 'Machinery', 106, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (326, 'Accumulated Depreciation - Machinery', 107, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (227, 'Agricultural, Fishery and Forestry and Equipment', 108, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (327, 'Accumulated Depreciation - Agricultural and Forestry Equipment', 109, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (228, 'Airport Equipment', 110, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (328, 'Accumulated Depreciation - Airport Equipment', 111, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (229, 'Communication Equipment ', 112, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (329, 'Accumulated Depreciation - Communication Equipment', 113, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (230, 'Construction and Heavy Equipment', 114, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (330, 'Accumulated Depreciation - Construction and Heavy Equipment', 115, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (231, 'Firefighting Equipment and Accessories', 116, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (331, 'Accumulated Depreciation - Firefighting Equipment', 117, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (232, 'Hospital Equipment', 118, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (332, 'Accumulated Depreciation - Hospital Equipment', 119, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (233, 'Medical, Dental and Laboratory Equipment', 120, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (333, 'Accumulated Depreciation - Medical, Dental and Laboratory Equipment', 121, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (234, 'Military and Police Equipment', 122, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (334, 'Accumulated Depreciation - Military and Police Equipment', 123, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (235, 'Sports Equipment', 124, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (335, 'Accumulated Depreciation - Sports Equipment', 125, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (236, 'Technical and Scientific Equipment', 126, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (336, 'Accumulated Depreciation- Technical and Scientific Equipment', 127, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (240, 'Other Machinery and Equipment', 128, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (340, 'Accumulated Depreciation -Other Machinery and Equipment', 129, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (241, 'Motor Vehicles', 130, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (341, 'Accumulated Depreciation - Motor Vehicles', 131, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (342, 'Accumulated Depreciation - Trains', 132, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (243, 'Aircrafts and Aircraft Ground Equipment ', 133, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (343, 'Accumulated Depreciation - Aircrafts and Aircraft', 134, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (244, 'Watercrafts', 135, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (344, 'Accumulated Depreciation - Watercrafts', 136, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (248, 'Other Transportation Equipment', 137, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (348, 'Accumulated Depreciation - Other Transportation Equipment', 138, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (250, 'Other Property, Plant and Equipment', 139, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (100, 'Accumulated Depreciation - Other Property, Plant and Equipment', 140, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (251, 'Roads, Highways and Bridges', 141, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (252, 'Parks, Plazas and Monuments', 142, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (253, 'Ports, Lighthouses and Harbors', 143, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (254, 'Irrigation, Canals, and Laterals', 144, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (255, 'Flood Controls', 145, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (256, 'Waterways, Aqueducts, Seawalls, River Walls and Others', 146, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (260, 'Other Public Infrastructures', 147, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (261, 'Reforestation - Upland', 148, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (262, 'Reforestation - Marshland/Swampland', 149, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (264, 'Construction in Progress -Agency Assets', 150, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (266, 'Construction in Progress - Roads, Highways and Bridges', 151, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (267, 'Construction in Progress - Parks, Plazas and Monuments', 152, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (268, 'Construction in Progress - Ports, Lighthouses and Harbors', 153, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (269, 'Construction in Progress - Artesian Wells, Reservoirs, Pumping Stations and Counduits', 154, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (270, 'Construction in Progress - Irrigation, Canals and Laterals', 155, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (271, 'Construction in Progress - Flood Controls', 156, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (272, 'Construction in Progress - Waterways, Aqueducts, Seawalls, River Walls and Others', 157, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (273, 'Construction in Progress - Other Public Infrastructures', 158, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (274, 'Construction in Progress - Reforestation - Upland', 159, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (275, 'Construction in Progress - Reforestation - Marshland/Swampland', 160, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (281, 'Work/Other Animals', 161, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (282, 'Breeding Stocks', 162, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (283, 'Arts, Archeological Specimens and Other Exhibits', 163, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (284, 'Items in Transit', 164, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (285, 'Restricted Fund/Cash', 165, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (290, 'Other Assets', 166, 'Asset', 'Debit', 0, 0);
INSERT INTO ledger VALUES (401, 'Accounts Payable', 167, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (402, 'Notes Payable', 168, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (403, 'Due to Officers and Employees', 169, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (408, 'Dividend Payable', 170, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (409, 'Interest Payable', 171, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (411, 'Due to National Treasury', 172, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (412, 'Due to BIR', 173, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (413, 'Due to GSIS', 174, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (414, 'Due to PAG-IBIG', 175, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (415, 'Due to PHILHEALTH', 176, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (416, 'Due to Other NGAs', 177, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (417, 'Due to Other GOCCs', 178, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (418, 'Due to LGUs', 179, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (421, 'Due to Central Office/Home Office', 180, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (422, 'Due to Regional Offices/Staff Bureaus/Branch Offices', 181, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (423, 'Due to Operating Units', 182, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (424, 'Due to Other Funds', 183, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (425, 'Due to Subsidiaries/Affiliates', 184, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (426, 'Guaranty Deposits Payable', 185, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (427, 'Performance/Bidders/Bail Bonds Payable', 186, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (428, 'Currency Swap Payable', 187, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (429, 'Tax Refunds Payable', 188, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (439, 'Other Payables', 189, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (441, 'Mortgage Payable', 190, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (442, 'Bonds Payable - Domestic', 191, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (443, 'Bonds Payable - Foreign', 192, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (444, 'Loans Payable - Domestic', 193, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (445, 'Loans Payable - Foreign', 194, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (450, 'Other Long-Term Liabilities', 195, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (451, 'Deferred Real Property Tax Income', 196, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (452, 'Deferred Special Education Tax Income', 197, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (455, 'Other Deferred Credits', 198, 'Liability', 'Credit', 0, 0);
INSERT INTO ledger VALUES (501, 'Government Equity', 199, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (502, 'Capital Stock', 200, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (503, 'Paid in Capital in Excess of Par Value', 201, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (504, 'Subscribed Capital Stock', 202, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (505, 'Restricted Capital', 203, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (506, 'Appraisal Capital Stock', 204, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (507, 'Treasury Stock', 205, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (510, 'Retained Earnings', 206, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (511, 'Cost of Goods Sold', 207, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (512, 'Income and Expense Summary', 208, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (551, 'Business Tax - National', 209, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (552, 'Capital Gains Tax', 210, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (553, 'Documentary Stamp Tax', 211, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (554, 'Donors Tax', 212, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (555, 'Estate Tax', 213, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (556, 'Excise Tax on Articles', 214, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (557, 'Final Tax', 215, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (558, 'Franchise Tax - National', 216, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (559, 'Immigration Tax', 217, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (560, 'Import Duties', 218, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (561, 'Income Tax- Individuals', 219, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (562, 'Income Tax- Partnerships', 220, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (563, 'Income Tax- Corporations', 221, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (564, 'Professional Tax', 222, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (565, 'Stock Transfer Tax', 223, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (566, 'Tax on Forest Products', 224, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (567, 'Value Added Tax', 225, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (568, 'Value Added Tax- Expanded', 226, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (569, 'Travel Tax', 227, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (578, 'Other National Taxes', 228, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (579, 'Fines and Penalties- National Taxes', 229, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (581, 'Amusement Tax', 230, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (582, 'Business Tax - Local', 231, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (583, 'Community Tax', 232, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (584, 'Franchise Tax - Local', 233, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (585, 'Occupation Tax', 234, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (586, 'Printing and Publication Tax', 235, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (587, 'Property Transfer Tax', 236, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (588, 'Real Property Tax', 237, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (589, 'Real Property Tax on Idle Lands', 238, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (590, 'Special Assessment Tax', 239, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (591, 'Special Education Tax', 240, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (592, 'Tax on Delivery Trucks and Vans', 241, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (593, 'Tax on Sand, Gravel and Other Quarry Products', 242, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (598, 'Other Local Taxes', 243, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (599, 'Fines and Penalties - Local Taxes', 244, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (601, 'Fees on Weights and Measures', 245, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (602, 'Fishery Rental Fees', 246, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (603, 'Franchising and Licensing Fees', 247, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (604, 'Motor Vehicles Users Charge', 248, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (605, 'Permit Fees', 249, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (606, 'Registration Fees', 250, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (608, 'Other Permits and Licenses', 251, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (609, 'Fines and Penalties - Permits and Licenses', 252, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (611, 'Affiliation Fees', 253, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (612, 'Athletic and Cultural Fees', 254, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (613, 'Clearance and Certification Fees', 255, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (614, 'Comprehensive Examination Fees', 256, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (615, 'Diploma and Graduation Fees', 257, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (616, 'Garbage Fees', 258, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (617, 'Inspection Fees', 259, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (618, 'LibraryFees', 260, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (619, 'Medical, Dental and Laboratory Fees', 261, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (620, 'Passport and Visa Fees', 262, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (621, 'Processing Fees', 263, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (622, 'Seminar Fees', 264, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (623, 'Toll and Terminal Fees', 265, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (624, 'Transcript of Record Fees', 266, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (628, 'Other Service Income', 267, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (629, 'Fines and Penalties - Service Income', 268, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (631, 'Hospital Fees', 269, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (632, 'Income from Canteen Operations', 270, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (633, 'Income from Cemetery Operations', 271, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (634, 'Income from Communication Facilities', 272, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (635, 'Income from Dormitory Operations', 273, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (636, 'Income from Markets', 274, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (637, 'Income from Slaughterhouses', 275, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (638, 'Income from Transportation System', 276, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (639, 'Income from Waterworks System', 277, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (640, 'Landing and Parking Fees', 278, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (641, 'Printing and Publication Income', 279, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (642, 'Rent Income', 280, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (643, 'Sales Revenue', 281, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (644, 'Tuition Fees', 282, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (648, 'Other Business Income', 283, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (650, 'Fines and Penalties- Business Income', 284, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (651, 'Subsidy Income from National Government', 285, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (652, 'Subsidy from Other National Government Agencies', 286, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (653, 'Subsidy from Central Office/Home Office', 287, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (654, 'Subsidy from Regional Offices/Staff Bureaus/Branch', 288, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (655, 'Subsidy from Operating Units', 289, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (656, 'Subsidy from Other LGUs', 290, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (657, 'Subsidy from Other Funds', 291, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (658, 'Subsidy from Subsidiaries/Affiliates', 292, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (661, 'Dividend Income', 293, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (662, 'Income from Grants and Donations', 294, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (663, 'Insurance Income', 295, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (664, 'Interest Income', 296, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (665, 'Internal Revenue Allotment', 297, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (666, 'Sale of Confiscated/Abandoned/Seized Goods and Properties', 298, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (667, 'Share from Economic Zones', 299, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (668, 'Share from Expanded Value Added Tax', 300, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (669, 'Share from National Wealth', 301, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (670, 'Share from PAGCOR/PCSO', 302, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (671, 'Share from Tobacco Excise Tax', 303, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (678, 'Miscellaneous Income', 304, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (679, 'Other Fines and Penalties', 305, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (681, 'Gain/Loss on Foreign Exchange (FOREX)', 306, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (682, 'Gain/Loss on Sale of Disposed Assets', 307, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (683, 'Gain/Loss on Sale of Securities', 308, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (684, 'Prior Years Adjustments', 309, 'Capital', 'Credit', 0, 0);
INSERT INTO ledger VALUES (701, 'Salaries and Wages - Regular', 310, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (702, 'Salaries and Wages - Military/Uniformed', 311, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (703, 'Salaries and Wages - Part-time', 312, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (704, 'Salaries and Wages - Substitute', 313, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (705, 'Salaries and Wages - Casual', 314, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (706, 'Salaries and Wages - Contractual', 315, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (707, 'Salaries and Wages - Emergency', 316, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (711, 'Personal Economic Relief Allowance (PERA)', 317, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (712, 'Additional Compensation (ADCOM)', 318, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (713, 'Representation Allowance (RA)', 319, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (714, 'Transportation Allowance (TA)', 320, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (715, 'Clothing/Uniform Allowance', 321, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (716, 'Subsistence, Laundry and Quarters Allowances', 322, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (717, 'Productivity Incentive Allowance', 323, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (718, 'Overseas Allowance', 324, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (719, 'Other Bonuses and Allowances', 325, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (720, 'Honoraria', 326, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (721, 'Hazard Pay', 327, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (722, 'Longevity Pay', 328, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (723, 'Overtime and Night Pay', 329, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (724, 'Cash Gift', 330, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (725, 'Year End Bonus', 331, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (731, 'Life and Retirement Insurance Contributions', 333, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (732, 'PAG-IBIG Contributions', 334, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (733, 'PHILHEALTH Contributions', 335, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (734, 'ECC Contributions', 336, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (738, 'Pension Benefits - Civilian', 337, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (739, 'Pension Benefits- Military/Uniformed', 338, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (740, 'Retirement Benefits- Civilian', 339, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (741, 'Retirement Benefits- Military/Uniformed', 340, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (742, 'Terminal Leave Benefits', 341, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (743, 'Health Workers Benefits', 342, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (749, 'Other Personnel Benefits', 343, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (751, 'Traveling Expenses - Local', 344, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (752, 'Traveling Expenses - Foreign', 345, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (753, 'Training Expenses', 346, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (754, 'Scholarship Expenses', 347, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (755, 'Office Supplies Expenses', 348, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (756, 'Accountable Forms Expenses', 349, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (757, 'Animal/Zoological Supplies Expenses', 350, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (758, 'Food Supplies Expenses', 351, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (759, 'Drugs and Medicines Expenses', 352, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (760, 'Medical, Dental and Laboratory Supplies Expenses', 353, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (761, 'Gasoline, Oil and Lubricants Expenses', 354, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (762, 'Agricultural Supplies Expenses', 355, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (763, 'Textbooks and Instructional Materials Expenses', 356, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (764, 'Military and Police Supplies Expenses', 357, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (765, 'Other Supplies Expenses', 358, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (766, 'Water Expenses', 359, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (767, 'Electricity Expenses', 360, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (768, 'Cooking Gas Expenses', 361, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (771, 'Postage and Deliveries', 362, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (772, 'Telephone Expenses - Landline', 363, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (773, 'Telephone Expenses - Mobile', 364, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (774, 'Internet Expenses', 365, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (778, 'Membership Dues and Contribution to Organizations', 366, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (779, 'Awards and Indemnities', 367, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (780, 'Advertising Expenses', 368, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (781, 'Printing and Binding Expenses', 369, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (782, 'Rent Expenses', 370, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (783, 'Representation Expenses', 371, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (784, 'Transportation and Delivery Expenses', 372, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (785, 'Storage Expenses', 373, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (786, 'Subscription Expenses', 374, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (787, 'Survey Expenses', 375, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (788, 'Rewards and Other Claims', 376, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (792, 'Auditing Services', 377, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (793, 'Consultancy Services', 378, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (794, 'Environment/Sanitary Services', 379, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (795, 'General Services', 380, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (796, 'Janitorial Services', 381, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (797, 'Security Services', 382, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (799, 'Other Professional Services', 383, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (802, 'Repairs and Maintenance - Land Improvements', 384, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (803, 'Repairs and Maintenance - Runways/Taxiways', 385, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (804, 'Repairs and Maintenance - Railways', 386, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (805, 'Repairs and Maintenance - Electrification, Power and Energy Structures', 387, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (811, 'Repairs and Maintenance - Office Buildings', 388, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (812, 'Repairs and Maintenance - School buildings', 389, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (813, 'Repairs and Maintenance - Hospitals and Health Centers', 390, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (814, 'Repairs and Maintenance - Markets and Slaughterhouses', 391, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (815, 'Repairs and Maintenance - Other Structures', 392, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (818, 'Repairs and Maintenance- Leasehold Improvements, Land', 393, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (819, 'Repairs and Maintenance- Leasehold Improvements, Buildings', 394, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (820, 'Repairs and Maintenance - Other Leasehold Improvements', 395, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (821, 'Repairs and Maintenance- Office Equipment', 396, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (822, 'Repairs and Maintenance - Furniture and Fixtures', 397, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (823, 'Repairs and Maintenance- IT Equipment and Software', 398, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (826, 'Repairs and Maintenance - Machinery', 399, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (827, 'Repairs and Maintenance - Agricultural, Fishery and Forestry Equipment', 400, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (828, 'Repairs and Maintenance - Airport Equipment', 401, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (829, 'Repairs and Maintenance - Communication Equipment', 402, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (830, 'Repairs and Maintenance - Construction and Heavy Equipment', 403, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (831, 'Repairs and Maintenance - Firefighting Equipment and Accessories', 404, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (832, 'Repairs and Maintenance - Hospital Equipment', 405, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (833, 'Repairs and Maintenance - Medical, Dental  and Laboratory Equipment', 406, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (834, 'Repairs and Maintenance - Military and Police Equipment', 407, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (835, 'Repairs and Maintenance - Sports Equipment', 408, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (836, 'Repairs and Maintenance - Technical and Scientific Equipment', 409, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (840, 'Repairs and Maintenance - Other Machinery and Equipment', 410, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (841, 'Repairs and Maintenance - Motor Vehicles', 411, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (842, 'Repairs and Maintenance - Trains', 412, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (843, 'Repairs and Maintenance - Aircrafts and Aircraft', 413, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (844, 'Repairs and Maintenance - Watercrafts', 414, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (848, 'Repairs and Maintenance - Other Transportation Equipment', 415, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (850, 'Repairs and Maintenance - Other Property, Plant and Equipment', 416, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (851, 'Repairs and Maintenance - Roads, Highways and Bridges', 417, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (852, 'Repairs and Maintenance - Parks, Plazas and Monuments', 418, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (853, 'Repairs and Maintenance - Ports, Lighthouses and Harbors', 419, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (854, 'Repairs and Maintenance - Artesian Wells, Reservoir, Pumping Stations and Conduits', 420, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (855, 'Repairs and Maintenance - Irrigation, Canals and Laterals', 421, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (856, 'Repairs and Maintenance - Flood Controls', 422, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (857, 'Repairs and Maintenance - Waterways, Aqueducts, Seawalls, River Walls and Others', 423, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (860, 'Repairs and Maintenance - Other Public', 424, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (861, 'Repairs and Maintenance - Reforestation - Upland', 425, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (862, 'Repairs and Maintenance - Reforestation - Marshland/Swampland', 426, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (871, 'Subsidy to National Government Agencies', 427, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (872, 'Subsidy to Regional Offices/Staff Bureaus/Branch Offices', 428, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (873, 'Subsidy to Operating Units', 429, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (874, 'Subsidy to Local Government Units', 430, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (875, 'Subsidy to Government Owned and/or Controlled Corporations', 431, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (876, 'Subsidy to NGOs/POs', 432, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (877, 'Subsidy to Other Funds', 433, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (878, 'Donations', 434, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (881, 'Confidential Expenses', 435, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (882, 'Intelligence Expenses', 436, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (883, 'Extraordinary Expenses', 437, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (884, 'Miscellaneous Expenses', 438, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (891, 'Taxes, Duties and Licenses', 439, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (892, 'Fidelity Bond Premiums', 440, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (893, 'Insurance Expenses', 441, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (901, 'Bad Debts Expenses', 442, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (902, 'Depreciation - Land Improvements', 443, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (903, 'Depreciation - Runways/Taxiways', 444, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (904, 'Depreciation - Railways', 445, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (905, 'Depreciation - Electrification, Power and Energy Structures', 446, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (911, 'Depreciation - Office Buildings', 447, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (912, 'Depreciation - School Buildings', 448, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (913, 'Depreciation - Hospitals and Health Centers', 449, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (914, 'Depreciation - Markets and Slaughterhouses', 450, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (915, 'Depreciation - Other Structures', 451, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (918, 'Depreciation - Leasehold Improvements, Land', 452, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (919, 'Depreciation - Leasehold Improvements, Buildings', 453, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (920, 'Depreciation - Other Leasehold Improvements', 454, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (921, 'Depreciation - Office Equipment', 455, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (922, 'Depreciation - Furniture and Fixtures', 456, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (923, 'Depreciation - IT Equipment', 457, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (924, 'Depreciation - Library Books', 458, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (926, 'Depreciation - Machinery', 459, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (927, 'Depreciation - Agricultural, Fishery and Forestry Equipmet', 460, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (928, 'Depreciation - Airport Equipment', 461, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (929, 'Depreciation - Communication Equipment', 462, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (930, 'Depreciation - Construction and Heavy Equipment', 463, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (931, 'Depreciation - Firefighting Equipment and Accessories', 464, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (932, 'Depreciation - Hospital Equipment', 465, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (933, 'Depreciation - Medical, Dental and Laboratory Equipment', 466, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (934, 'Depreciation - Military and Police Equipment', 467, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (935, 'Depreciation - Sports Equipment', 468, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (936, 'Depreciation - Technical and Scientific Equipment', 469, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (940, 'Depreciation - Other Machineries and Equipment', 470, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (941, 'Depreciation - Motor Vehicles', 471, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (942, 'Depreciation -Trains', 472, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (943, 'Depreciation - Aircrafts and Aircraft Ground Equipment', 473, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (944, 'Depreciation - Watercrafts', 474, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (948, 'Depreciation - Other Transportation Equipment', 475, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (950, 'Depreciation - Other Property, Plant and Equipment', 476, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (951, 'Obsolescence - IT Software', 477, 'Contra-Asset', 'Credit', 0, 0);
INSERT INTO ledger VALUES (957, 'Loss from Tax Exemptions', 478, 'Capital', 'Debit', 0, 0);
INSERT INTO ledger VALUES (958, 'Tax Refunds', 479, 'Capital', 'Debit', 0, 0);
INSERT INTO ledger VALUES (961, 'Loss of Assets', 480, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (962, 'Loss on Guaranty', 481, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (969, 'Other Maintenance and Operating Expenses', 482, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (971, 'Bank Charges', 483, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (972, 'Commitment Fees', 484, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (973, 'Debt Service Subsidy to GOCCs', 485, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (974, 'Documentary Stamp Expenses', 486, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (975, 'Interest Expenses', 487, 'Expense', 'Debit', 0, 0);
INSERT INTO ledger VALUES (979, 'Other Financial Charges', 488, 'Expense', 'Debit', 0, 0);


--
-- Data for Name: ledger_entries; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: ledger_entries_ledger_entry_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ledger_entries_ledger_entry_id_seq', 22, true);


--
-- Data for Name: log; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: log_log_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('log_log_id_seq', 2, true);


--
-- Data for Name: particulars; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: particulars_particular_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('particulars_particular_id_seq', 57, true);


--
-- Data for Name: posted_journal_entry; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: posted_journal_entry_posted_entry_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('posted_journal_entry_posted_entry_seq', 6, true);


--
-- Data for Name: status_holder; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO status_holder VALUES (51, 1, 0, 0, '2014-12-02', 1);


--
-- Name: status_holder_status_holder_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('status_holder_status_holder_id_seq', 51, true);


--
-- Data for Name: transaction_number; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO transaction_number VALUES (1, 0);


--
-- Name: transaction_number_transaction_number_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('transaction_number_transaction_number_id_seq', 1, true);


--
-- Data for Name: trial_balance; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: trial_balance_date; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO trial_balance_date VALUES (1, '2014-11-18');


--
-- Name: trial_balance_date_trial_balance_asof_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('trial_balance_date_trial_balance_asof_id_seq', 7, true);


--
-- Name: trial_balance_trial_balance_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('trial_balance_trial_balance_id_seq', 118, true);


--
-- Data for Name: trial_monthly; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO trial_monthly VALUES (186, 'Cash - In Vault', 101, 0, 0);
INSERT INTO trial_monthly VALUES (187, 'Accounts Receivable', 121, 0, 0);
INSERT INTO trial_monthly VALUES (188, 'Land', 201, 70000, 0);
INSERT INTO trial_monthly VALUES (189, 'Office Buildings', 211, 0, 0);
INSERT INTO trial_monthly VALUES (190, 'Accounts Payable', 401, 0, 70000);


--
-- Name: trial_monthly_trial_balance_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('trial_monthly_trial_balance_id_seq', 190, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO users VALUES (2, 'admin', 'admin', '', 'admin', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO users VALUES (3, 'edward', 'magsino', '', 'edward', 'a53f3929621dba1306f8a61588f52f55');


--
-- Name: users_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_user_id_seq', 3, true);


--
-- Name: audit_trail_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY audit_trail
    ADD CONSTRAINT audit_trail_pkey PRIMARY KEY (audit_trail_id);


--
-- Name: date_generated_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY date_generated
    ADD CONSTRAINT date_generated_pkey PRIMARY KEY (date_generated_id);


--
-- Name: journal_entry_journal_page_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY journal_entry
    ADD CONSTRAINT journal_entry_journal_page_key UNIQUE (journal_page);


--
-- Name: journal_entry_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY journal_entry
    ADD CONSTRAINT journal_entry_pkey PRIMARY KEY (journal_id);


--
-- Name: journal_entry_transaction_number_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY journal_entry
    ADD CONSTRAINT journal_entry_transaction_number_key UNIQUE (transaction_number);


--
-- Name: ledger_account_title_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ledger
    ADD CONSTRAINT ledger_account_title_key UNIQUE (account_title);


--
-- Name: ledger_entries_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ledger_entries
    ADD CONSTRAINT ledger_entries_pkey PRIMARY KEY (ledger_entry_id);


--
-- Name: ledger_ledger_page_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ledger
    ADD CONSTRAINT ledger_ledger_page_key UNIQUE (ledger_page);


--
-- Name: ledger_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ledger
    ADD CONSTRAINT ledger_pkey PRIMARY KEY (account_code);


--
-- Name: log_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY log
    ADD CONSTRAINT log_pkey PRIMARY KEY (log_id);


--
-- Name: particulars_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY particulars
    ADD CONSTRAINT particulars_pkey PRIMARY KEY (particular_id);


--
-- Name: posted_journal_entry_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY posted_journal_entry
    ADD CONSTRAINT posted_journal_entry_pkey PRIMARY KEY (posted_entry);


--
-- Name: status_holder_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY status_holder
    ADD CONSTRAINT status_holder_pkey PRIMARY KEY (status_holder_id);


--
-- Name: transaction_number_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY transaction_number
    ADD CONSTRAINT transaction_number_pkey PRIMARY KEY (transaction_number_id);


--
-- Name: trial_balance_account_code_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY trial_balance
    ADD CONSTRAINT trial_balance_account_code_key UNIQUE (account_code);


--
-- Name: trial_balance_account_title_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY trial_balance
    ADD CONSTRAINT trial_balance_account_title_key UNIQUE (account_title);


--
-- Name: trial_balance_date_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY trial_balance_date
    ADD CONSTRAINT trial_balance_date_pkey PRIMARY KEY (trial_balance_date_id);


--
-- Name: trial_balance_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY trial_balance
    ADD CONSTRAINT trial_balance_pkey PRIMARY KEY (trial_balance_id);


--
-- Name: trial_monthly_account_code_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY trial_monthly
    ADD CONSTRAINT trial_monthly_account_code_key UNIQUE (account_code);


--
-- Name: trial_monthly_account_title_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY trial_monthly
    ADD CONSTRAINT trial_monthly_account_title_key UNIQUE (account_title);


--
-- Name: trial_monthly_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY trial_monthly
    ADD CONSTRAINT trial_monthly_pkey PRIMARY KEY (trial_balance_id);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (user_id);


--
-- Name: users_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_username_key UNIQUE (username);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

